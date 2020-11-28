<?php

namespace qlwz\mock;

/**
 * Class Mock
 *
 * @package qlwz\mock
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */
class Mock
{
    /**
     * 处理Mock
     *
     * @param mixed     $template 属性值（即数据模板）
     * @param string    $name     属性名
     * @param \stdClass $context  数据上下文，生成后的数据
     * @return mixed
     */
    public static function mock($template, $name = null, $context = null)
    {
        return self::generate($template, $name, $context);
    }

    /**
     * 处理Mock
     *
     * @param mixed     $template 属性值（即数据模板）
     * @param string    $name     属性名
     * @param \stdClass $context  数据上下文，生成后的数据
     * @return mixed
     */
    public static function generate(&$template, $name = null, $context = null)
    {
        if ($name == null) {
            $name = '';
        }

        if ($context == null) {
            $context = self::getDefaultContext();
        }

        $newContext                         = new \stdClass();
        $newContext->path                   = $context->path ?: [Constant::$GUID];  // 当前访问路径，只有属性名，不包括生成规则
        $newContext->templatePath           = $context->templatePath ?: [Constant::$GUID++];
        $newContext->currentContext         = $context->currentContext;     // 最终属性值的上下文
        $newContext->templateCurrentContext = $context->templateCurrentContext ?: $template;    // 属性值模板的上下文
        $newContext->root                   = $context->root ?: $context->currentContext;   // 最终值的根
        $newContext->templateRoot           = $context->templateRoot ?: $context->templateCurrentContext ?: $template; // 模板的根

        $type   = Util::getType($template);
        $method = $type . 'Mock';
        if (method_exists(__CLASS__, $method)) {
            $rule     = Util::parseRule($name);
            $newValue = self::{$method} ($rule, $template, $newContext, $name);
            if (!$context->root) {
                $context->root = $newValue;
            }
            return $newValue;
        } else {
            return $template;
        }
    }

    /**
     * Mock array
     *
     * @param \stdClass $rule
     * @param mixed     $template
     * @param \stdClass $context
     * @param string    $name
     * @return array
     */
    public static function arrayMock($rule, &$template, $context, $name)
    {
        $result = [];
        // 'name|1': []
        // 'name|count': []
        // 'name|min-max': []
        if (!is_array($template) || count($template) == 0) {
            return $result;
        }

        // 'arr': [{ 'email': '@EMAIL' }, { 'email': '@EMAIL' }]
        if (!$rule) {
            foreach ($template as $key => $value) {
                self::pushContext($context, $key, $key);
                $newContext = self::getNewContext($result, $template, $context);
                $gen        = self::generate($value, $key, $newContext);
                $result[]   = $gen;
                self::popContext($context);
            }
        } else {
            // 'method|1': ['GET', 'POST', 'HEAD', 'DELETE']
            if ($rule->min === 1 && $rule->max === null) {
                self::pushContext($context, $name, $name);
                $newContext = self::getNewContext($result, $template, $context);
                $gen        = self::generate($template, null, $newContext);
                $result     = $gen[array_rand($gen, 1)];
                self::popContext($context);
            } else {
                // 'data|+1': [{}, {}]
                if (isset ($rule->parameters[2]) && $rule->parameters[2]) {
                    $template['__order_index'] = isset ($template['__order_index']) ? intval($template['__order_index']) : 0;

                    self::pushContext($context, $name, $name);
                    $newContext = self::getNewContext($result, $template, $context);
                    $gen        = self::generate($template, null, $newContext);
                    $result     = $gen[$template['__order_index'] % (count($template) - 1)];

                    $template['__order_index'] += intval($rule->parameters[2]);
                    self::popContext($context);
                } else {
                    // 'data|1-10': [{}]
                    for ($i = 0; $i < $rule->count; $i++) {
                        // 'data|1-10': [{}, {}]
                        foreach ($template as $key => $value) {
                            self::pushContext($context, count($result), $key);
                            $newContext = self:: getNewContext($result, $template, $context);
                            $gen        = self::generate($value, count($result), $newContext);
                            $result[]   = $gen;
                            self::popContext($context);
                        }
                    }
                }
            }
        }
        return $result;
    }

    /**
     * Mock object
     *
     * @param \stdClass $rule
     * @param mixed     $template
     * @param \stdClass $context
     * @param string    $name
     * @return \stdClass
     */
    public static function objectMock($rule, $template, $context, $name)
    {
        $result = new \stdClass();

        // 'obj|min-max': {}
        if ($rule && $rule->count) {
            $keys = [];
            foreach ($template as $key => $value) {
                $keys[] = $key;
            }
            shuffle($keys);
            $count = $rule->count > count($keys) ? count($keys) : $rule->count;
            for ($i = 0; $i < $count; $i++) {
                $key   = $keys[$i];
                $value = $template->$key;

                $parameters = null;
                preg_match(Constant::RE_KEY, $key, $parameters);
                $parsedKey = $parameters ? $parameters[1] : $key;

                self::pushContext($context, $parsedKey, $key);
                $newContext         = self::getNewContext($result, $template, $context);
                $gen                = self::generate($value, $key, $newContext);
                $result->$parsedKey = $gen;
                self::popContext($context);
            }
        } else {
            // 'obj': {}
            foreach ($template as $key => &$value) {
                $parameters = null;
                preg_match(Constant::RE_KEY, $key, $parameters);
                $parsedKey = $parameters ? $parameters[1] : $key;

                self::pushContext($context, $parsedKey, $key);
                $newContext         = self::getNewContext($result, $template, $context);
                $gen                = self::generate($value, $key, $newContext);
                $result->$parsedKey = $gen;
                self::popContext($context);

                // 'id|+1': 1
                if ($parameters && isset ($parameters[2]) && $parameters[2] && Util::getType($value) === 'number') {
                    $value += intval($parameters[2]);
                }
            }
        }
        return $result;
    }

    /**
     * Mock number
     *
     * @param \stdClass $rule
     * @param mixed     $template
     * @param \stdClass $context
     * @param string    $name
     * @return int|float
     */
    public static function numberMock($rule, $template, $context, $name)
    {
        if ($rule == null) {
            return $template;
        }
        if ($rule->decimal) {// float
            $parts = explode('.', $template);
            // 'float1|.1-10': 10,
            // 'float2|1-100.1-10': 1,
            // 'float3|999.1-10': 1,
            // 'float4|.3-10': 123.123,
            $parts[0] = $rule->count ?: $parts[0];
            $parts[1] = isset ($parts[1]) ? $parts[1] : '';
            if (strlen($parts[1]) >= $rule->dcount) {
                $parts[1] = substr($parts[1], 0, $rule->dcount);
            } else {
                while (strlen($parts[1]) < $rule->dcount) {
                    $parts[1] .= (strlen($parts[1]) + 1 == $rule->dcount) ? rand(1, 9) : rand(0, 9); // 最后一位不能为 0：如果最后一位为 0，会被 JS 引擎忽略掉。
                }
            }
            return floatval($parts[0] . '.' . $parts[1]);
        } else {// integer
            // 'grade1|1-100': 1,
            return $rule->count ?: $template;
        }
    }

    /**
     * Mock boolean
     *
     * @param \stdClass $rule
     * @param mixed     $template
     * @param \stdClass $context
     * @param string    $name
     * @return bool
     */
    public static function booleanMock($rule, $template, $context, $name)
    {
        if (!$rule) {
            return $template;
        }

        // 'prop|multiple': false, 当前值是相反值的概率倍数
        // 'prop|probability-probability': false, 当前值与相反值的概率
        $random = mt_rand() / mt_getrandmax();
        if ($template === true || $template === false) {
            $min = $rule->min ? intval($rule->min) : 1;
            $max = $rule->max ? intval($rule->max) : 1;
            return $random > (1.0 / ($min + $max) * $min) ? !$template : $template;
        }

        return $random >= 0.5;
    }

    /**
     * Mock string
     *
     * @param \stdClass $rule
     * @param mixed     $template
     * @param \stdClass $context
     * @param string    $name
     * @return string
     */
    public static function stringMock($rule, $template, $context, $name)
    {
        if ($template) {
            $result = '';

            if ($rule && $rule->count) {
                // 'star|1-5': '★',
                for ($i = 0; $i < $rule->count; $i++) {
                    $result .= $template;
                }
            } else {
                //  'foo': '★',
                $result = $template;
            }

            // 'email|1-10': '@EMAIL, ',
            $placeholders = null;
            preg_match_all(Constant::RE_PLACEHOLDER, $result, $placeholders);
            if ($placeholders) {
                Util::loadFunction();
                $placeholders = $placeholders[0];
                foreach ($placeholders as $k => $ph) {
                    // 遇到转义斜杠，不需要解析占位符
                    if ($ph[0] == '\\') {
                        $result = Util::str_replace_once($ph, '[\@-PLACEHOLDER-\@]' . substr($ph, 2), $result);
                        unset ($placeholders[$k]);
                        continue;
                    }
                    $phed = self::placeholder($ph, $context->currentContext, $context->templateCurrentContext, $context);

                    // 只有一个占位符，并且没有其他字符
                    if (count($placeholders) === 1 && $ph === $result && gettype($phed) !== gettype($result)) {
                        $result = $phed;
                        break;
                        /*
                          if (Util.isNumeric(phed)) {
                          result = parseFloat(phed, 10)
                          break
                          }
                          if (/^(true|false)$/.test(phed)) {
                          result = phed === 'true' ? true :
                          phed === 'false' ? false :
                          phed // 已经是布尔值
                          break
                          }
                         */
                    }
                    $result = Util::str_replace_once($ph, $phed, $result);
                }
                if (is_string($result)) {
                    $result = Util::str_replace_once('[\@-PLACEHOLDER-\@]', '@', $result);
                }
            }
            return $result;
        } else {
            // 'ASCII|1-10': '',
            // 'ASCII': '',
            return $rule && $rule->range ? Util::random($rule->count) : $template;
        }
    }

    /**
     * 处理占位符
     *
     * @param string    $placeholder
     * @param mixed     $obj
     * @param mixed     $templateContext
     * @param \stdClass $context
     * @return string
     */
    private static function placeholder($placeholder, $obj, $templateContext, $context)
    {
        // 1 key, 2 params
        $parts = null;
        preg_match(Constant::RE_PLACEHOLDER, $placeholder, $parts);
        if (!$parts) {
            return $placeholder;
        }
        $key = $parts[1];
        // 占位符优先引用数据模板中的属性
        $out = Util::getObject($obj, $key);
        if ($out) {
            return $out;
        }

        $pathParts = Util::splitPathToArray($key);
        // 绝对路径 or 相对路径
        if ($key[0] === '/' || count($pathParts) > 1) {
            return self::getValueByKeyPath($key, $context);
        }

        // 递归引用数据模板中的属性
        if ($templateContext && is_object($templateContext) && Util::inObject($templateContext, $key) && Util::getObject($templateContext, $key) !== $placeholder) {
            // 先计算被引用的属性值
            $cc                         = new \stdClass();
            $cc->path                   = null;
            $cc->templatePath           = null;
            $cc->currentContext         = $obj;
            $cc->templateCurrentContext = $templateContext;
            $cc->root                   = null;
            $cc->templateRoot           = null;

            $tmp = Util::getObject($templateContext, $key);
            $gen = self::generate($tmp, $key, $cc);
            return $gen;
        }

        $function = 'mock_random_' . strtolower($key);
        // 如果未找到，则原样返回
        if (!function_exists($function)) {
            return $placeholder;
        }

        //$params = isset ($parts[2]) && $parts[2] ? preg_split ('/,\s*/', $parts[2]) : array();
        $params = isset ($parts[2]) && $parts[2] ? Util::getParam($parts[2]) : array();
        // 递归解析参数中的占位符
        foreach ($params as $k => $v) {
            if (is_string($v) && preg_match(Constant::RE_PLACEHOLDER, $v, $parts) && $parts) {
                $params[$k] = self::placeholder($v, $obj, $templateContext, $context);
            }
        }

        //执行占位符方法
        $result = call_user_func_array($function, $params);
        if ($result === null) {
            // 因为是在字符串中，所以默认为空字符串。
            $result = '';
        }
        return $result;
    }

    /**
     * 通过路径取得值
     *
     * @param string    $key
     * @param \stdClass $context
     * @return string
     */
    private static function getValueByKeyPath($key, $context)
    {
        $keyPathParts      = Util::splitPathToArray($key);
        $absolutePathParts = [];

        if ($key[0] === '/') { // 绝对路径
            $absolutePathParts = array_merge([$context->path[0]], Util::normalizePath($keyPathParts));
        } else {// 相对路径
            if (count($keyPathParts) > 1) {
                $tmp = $context->path;
                array_pop($tmp);
                $absolutePathParts = Util::normalizePath(array_merge($tmp, $keyPathParts));
            }
        }

        $newKey                 = $keyPathParts[count($keyPathParts) - 1];
        $currentContext         = $context->root;
        $templateCurrentContext = $context->templateRoot;
        for ($i = 1; $i < count($absolutePathParts) - 1; $i++) {
            $currentContext         = is_array($currentContext) ? $currentContext[$absolutePathParts[$i]] : $currentContext->$absolutePathParts[$i];
            $templateCurrentContext = is_array($templateCurrentContext) ? $templateCurrentContext[$absolutePathParts[$i]] : $templateCurrentContext->$absolutePathParts[$i];
        }

        // 引用的值已经计算好
        $out = Util::getObject($currentContext, $newKey);
        if ($out) {
            return $out;
        }

        // 尚未计算，递归引用数据模板中的属性
        if ($templateCurrentContext && is_object($templateCurrentContext) && Util::inObject($templateCurrentContext, $newKey) && Util::getObject($templateCurrentContext, $newKey) !== $key) {
            // 先计算被引用的属性值
            $cc                         = new \stdClass();
            $cc->path                   = null;
            $cc->templatePath           = null;
            $cc->currentContext         = $currentContext;
            $cc->templateCurrentContext = $templateCurrentContext;
            $cc->root                   = null;
            $cc->templateRoot           = null;

            $tmp = Util::getObject($templateCurrentContext, $newKey);
            $gen = self::generate($tmp, $newKey, $cc);
            return $gen;
        }

        return '';
    }

    /**
     * 获取默认的上下文关系
     *
     * @return \stdClass
     */
    private static function getDefaultContext()
    {
        $context                         = new \stdClass();
        $context->path                   = null;
        $context->templatePath           = null;
        $context->currentContext         = null;
        $context->templateCurrentContext = null;
        $context->root                   = null;
        $context->templateRoot           = null;
        return $context;
    }

    /**
     * 生成新的上下文关系
     *
     * @param mixed     $result
     * @param mixed     $template
     * @param \stdClass $context
     * @return \stdClass
     */
    private static function getNewContext($result, $template, $context)
    {
        $newContext                         = new \stdClass();
        $newContext->path                   = $context->path;   // 当前访问路径，只有属性名，不包括生成规则
        $newContext->templatePath           = $context->templatePath;
        $newContext->currentContext         = $result; // 最终属性值的上下文
        $newContext->templateCurrentContext = $template;  // 属性值模板的上下文
        $newContext->root                   = $context->root ?: $result;     // 最终值的根
        $newContext->templateRoot           = $context->templateRoot ?: $template;  // 模板的根
        return $newContext;
    }

    /**
     * 压出一个路径
     *
     * @param \stdClass $context
     * @param string    $path
     * @param string    $templatePath
     */
    private static function pushContext($context, $path, $templatePath)
    {
        array_push($context->path, $path);
        array_push($context->templatePath, $templatePath);
    }

    /**
     * 去除最后的路径
     *
     * @param \stdClass $context
     */
    private static function popContext($context)
    {
        array_pop($context->path);
        array_pop($context->templatePath);
    }
}
