<?php
/**
 * Mock 姓名随机
 *
 * @author  情留メ蚊子 <qlwz@qq.com>
 * @link    http://www.94qing.com
 */

/**
 * 随机生成一个常见的英文名。
 *
 * @return string
 */
function mock_random_first()
{
    $male   = [
        'James', 'John', 'Robert', 'Michael', 'William', 'David', 'Richard', 'Charles', 'Joseph', 'Thomas',
        'Christopher', 'Daniel', 'Paul', 'Mark', 'Donald', 'George', 'Kenneth', 'Steven', 'Edward', 'Brian', 'Ronald',
        'Anthony', 'Kevin', 'Jason', 'Matthew', 'Gary', 'Timothy', 'Jose', 'Larry', 'Jeffrey', 'Frank', 'Scott', 'Eric'
    ];
    $female = [
        'Mary', 'Patricia', 'Linda', 'Barbara', 'Elizabeth', 'Jennifer', 'Maria', 'Susan', 'Margaret', 'Dorothy',
        'Lisa', 'Nancy', 'Karen', 'Betty', 'Helen', 'Sandra', 'Donna', 'Carol', 'Ruth', 'Sharon', 'Michelle', 'Laura',
        'Sarah', 'Kimberly', 'Deborah', 'Jessica', 'Shirley', 'Cynthia', 'Angela', 'Melissa', 'Brenda', 'Amy', 'Anna'
    ];
    $names  = array_merge($male, $female);
    return $names[mt_rand(0, count($names) - 1)];
}

/**
 * 随机生成一个常见的英文姓。
 *
 * @return string
 */
function mock_random_last()
{
    $names = [
        'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia', 'Rodriguez', 'Wilson',
        'Martinez', 'Anderson', 'Taylor', 'Thomas', 'Hernandez', 'Moore', 'Martin', 'Jackson', 'Thompson', 'White',
        'Lopez', 'Lee', 'Gonzalez', 'Harris', 'Clark', 'Lewis', 'Robinson', 'Walker', 'Perez', 'Hall', 'Young', 'Allen'
    ];
    return $names[mt_rand(0, count($names) - 1)];
}

/**
 * 随机生成一个常见的英文姓名。
 *
 * @param bool $middle
 * @return string
 */
function mock_random_name($middle = null)
{
    return mock_random_first() . ' ' . ($middle ? mock_random_first() . ' ' : '') . mock_random_last();
}

/**
 * 随机生成一个常见的中文姓。
 *
 * @return string
 */
function mock_random_cfirst()
{
    $names = [
        '王', '李', '张', '刘', '陈', '杨', '赵', '黄', '周', '吴', '徐', '孙', '胡', '朱', '高', '林', '何', '郭', '马', '罗', '梁', '宋',
        '郑', '谢', '韩', '唐', '冯', '于', '董', '萧', '程', '曹', '袁', '邓', '许', '傅', '沈', '曾', '彭', '吕', '苏', '卢', '蒋', '蔡',
        '贾', '丁', '魏', '薛', '叶', '阎', '余', '潘', '杜', '戴', '夏', '锺', '汪', '田', '任', '姜', '范', '方', '石', '姚', '谭', '廖',
        '邹', '熊', '金', '陆', '郝', '孔', '白', '崔', '康', '毛', '邱', '秦', '江', '史', '顾', '侯', '邵', '孟', '龙', '万', '段', '雷',
        '钱', '汤', '尹', '黎', '易', '常', '武', '乔', '贺', '赖', '龚', '文'
    ];
    return $names[mt_rand(0, count($names) - 1)];
}

/**
 * 随机生成一个常见的中文名。
 *
 * @return string
 */
function mock_random_clast()
{
    $names = [
        '伟', '芳', '娜', '秀英', '敏', '静', '丽', '强', '磊', '军', '洋', '勇', '艳', '杰', '娟', '涛', '明', '超', '秀兰', '霞', '平', '刚',
        '桂英'
    ];
    return $names[mt_rand(0, count($names) - 1)];
}

/**
 * 随机生成一个常见的中文名。
 *
 * @return string
 */
function mock_random_cname()
{
    return mock_random_cfirst() . mock_random_clast();
}
