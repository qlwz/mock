<?php

$dpd = [];

$dpd['Basic']['mock_random_boolean( min?, max?, current? )'] = [
    '// mock_random_boolean()',
    'mock_random_boolean()',
    'Mock::mock(\'@boolean\')',
    'Mock::mock(\'@boolean()\')',
    '',
    '// mock_random_boolean( min, max, current )',
    'mock_random_boolean(1, 9, true)',
    'Mock::mock(\'@boolean(1, 9, true)\')'
];

$dpd['Basic']['mock_random_natural( min?, max? )'] = [
    '// mock_random_natural()',
    'mock_random_natural()',
    'Mock::mock(\'@natural\')',
    'Mock::mock(\'@natural()\')',
    '',
    '// mock_random_natural( min )',
    'mock_random_natural(10000)',
    'Mock::mock(\'@natural(10000)\')',
    '',
    '// mock_random_natural( min, max )',
    'mock_random_natural(60, 100)',
    'Mock::mock(\'@natural(60, 100)\')'
];

$dpd['Basic']['mock_random_integer( min?, max? )'] = [
    '// mock_random_integer()',
    'mock_random_integer()',
    'Mock::mock(\'@integer\')',
    'Mock::mock(\'@integer()\')',
    '',
    '// mock_random_integer( min )',
    'mock_random_integer(10000)',
    'Mock::mock(\'@integer(10000)\')',
    '',
    '// mock_random_integer( min, max )',
    'mock_random_integer(60, 100)',
    'Mock::mock(\'@integer(60, 100)\')'
];

$dpd['Basic']['mock_random_float( min?, max?, dmin?, dmax? )'] = [
    '// mock_random_float()',
    'mock_random_float()',
    'Mock::mock(\'@float\')',
    'Mock::mock(\'@float()\')',
    '',
    '// mock_random_float( min )',
    'mock_random_float(0)',
    'Mock::mock(\'@float(0)\')',
    '',
    '// mock_random_float( min, max )',
    'mock_random_float(60, 100)',
    'Mock::mock(\'@float(60, 100)\')',
    '',
    '// mock_random_float( min, max, dmin )',
    'mock_random_float(60, 100, 3)',
    'Mock::mock(\'@float(60, 100, 3)\')',
    '',
    '// mock_random_float( min, max, dmin, dmax )',
    'mock_random_float(60, 100, 3, 5)',
    'Mock::mock(\'@float(60, 100, 3, 5)\')',
    ''
];

$dpd['Basic']['mock_random_character( pool? )'] = [
    '// mock_random_character()',
    'mock_random_character()',
    'Mock::mock(\'@character\')',
    'Mock::mock(\'@character()\')',
    '',
    '// mock_random_character( \'lower/upper/number/symbol\' )',
    'mock_random_character(\'lower\')',
    'mock_random_character(\'upper\')',
    'mock_random_character(\'number\')',
    'mock_random_character(\'symbol\')',
    '',
    'Mock::mock(\'@character("lower")\')',
    'Mock::mock(\'@character("upper")\')',
    'Mock::mock(\'@character("number")\')',
    'Mock::mock(\'@character("symbol")\')',
    '',
    '// mock_random_character( pool )',
    'mock_random_character(\'aeiou\')',
    'Mock::mock(\'@character("aeiou")\')'
];

$dpd['Basic']['mock_random_string( pool?, min?, max? )'] = [
    '// mock_random_string()',
    'mock_random_string()',
    'Mock::mock(\'@string\')',
    'Mock::mock(\'@string()\')',
    '',
    '// mock_random_string( length )',
    'mock_random_string(5)',
    'Mock::mock(\'@string(5)\')',
    '',
    '// mock_random_string( pool, length )',
    'mock_random_string(\'lower\', 5)',
    'mock_random_string(\'upper\', 5)',
    'mock_random_string(\'number\', 5)',
    'mock_random_string(\'symbol\', 5)',
    'mock_random_string(\'aeiou\', 5)',
    '',
    'Mock::mock(\'@string("lower", 5)\')',
    'Mock::mock(\'@string("upper", 5)\')',
    'Mock::mock(\'@string("number", 5)\')',
    'Mock::mock(\'@string("symbol", 5)\')',
    'Mock::mock(\'@string("aeiou", 5)\')',
    '',
    '// mock_random_string( min, max )',
    'mock_random_string(7, 10)',
    'Mock::mock(\'@string(7, 10)\')',
    '',
    '// mock_random_string( pool, min, max )',
    'mock_random_string(\'lower\', 1, 3)',
    'mock_random_string(\'upper\', 1, 3)',
    'mock_random_string(\'number\', 1, 3)',
    'mock_random_string(\'symbol\', 1, 3)',
    'mock_random_string(\'aeiou\', 1, 3)',
    '',
    'Mock::mock(\'@string("lower", 1, 3)\')',
    'Mock::mock(\'@string("upper", 1, 3)\')',
    'Mock::mock(\'@string("number", 1, 3)\')',
    'Mock::mock(\'@string("symbol", 1, 3)\')',
    'Mock::mock(\'@string("aeiou", 1, 3)\')',
    ''
];

$dpd['Basic']['mock_random_range(start?, stop, step?)'] = [
    '// mock_random_range( stop )',
    'mock_random_range(10)',
    'Mock::mock(\'@range(10)\')',
    '',
    '// mock_random_range( start, stop )',
    'mock_random_range(3, 7)',
    'Mock::mock(\'@range(3, 7)\')',
    '',
    '// mock_random_range( start, stop, step )',
    'mock_random_range(1, 10, 2)',
    'mock_random_range(1, 10, 3)',
    '',
    'Mock::mock(\'@range(1, 10, 2)\')',
    'Mock::mock(\'@range(1, 10, 3)\')'
];

$dpd['Date']['mock_random_date( format? )'] = [
    '// mock_random_date()',
    'mock_random_date()',
    'Mock::mock(\'@date\')',
    'Mock::mock(\'@date()\')',
    '',
    '// mock_random_date( format )',
    'mock_random_date(\'yyyy-MM-dd\')',
    'mock_random_date(\'yy-MM-dd\')',
    'mock_random_date(\'y-MM-dd\')',
    'mock_random_date(\'y-M-d\')',
    '',
    'Mock::mock(\'@date("yyyy-MM-dd")\')',
    'Mock::mock(\'@date("yy-MM-dd")\')',
    'Mock::mock(\'@date("y-MM-dd")\')',
    'Mock::mock(\'@date("y-M-d")\')',
    '',
    'Mock::mock(\'@date("yyyy yy y MM M dd d")\')',
];

$dpd['Date']['mock_random_time( format? )'] = [
    '// mock_random_time()',
    'mock_random_time()',
    'Mock::mock(\'@time\')',
    'Mock::mock(\'@time()\')',
    '',
    '// mock_random_time( format )',
    'mock_random_time(\'A HH:mm:ss\')',
    'mock_random_time(\'a HH:mm:ss\')',
    'mock_random_time(\'HH:mm:ss\')',
    'mock_random_time(\'H:m:s\')',
    '',
    'Mock::mock(\'@time("A HH:mm:ss")\')',
    'Mock::mock(\'@time("a HH:mm:ss")\')',
    'Mock::mock(\'@time("HH:mm:ss")\')',
    'Mock::mock(\'@time("H:m:s")\')',
    '',
    'Mock::mock(\'@datetime("HH H hh h mm m ss s SS S A a T")\')',
];

$dpd['Date']['mock_random_datetime( format? )'] = [
    '// mock_random_datetime()',
    'mock_random_datetime()',
    'Mock::mock(\'@datetime\')',
    'Mock::mock(\'@datetime()\')',
    '',
    '// mock_random_datetime( format )',
    'mock_random_datetime(\'yyyy-MM-dd A HH:mm:ss\')',
    'mock_random_datetime(\'yy-MM-dd a HH:mm:ss\')',
    'mock_random_datetime(\'y-MM-dd HH:mm:ss\')',
    'mock_random_datetime(\'y-M-d H:m:s\')',
    '',
    'Mock::mock(\'@datetime("yyyy-MM-dd A HH:mm:ss")\')',
    'Mock::mock(\'@datetime("yy-MM-dd a HH:mm:ss")\')',
    'Mock::mock(\'@datetime("y-MM-dd HH:mm:ss")\')',
    'Mock::mock(\'@datetime("y-M-d H:m:s")\')',
    '',
    'Mock::mock(\'@datetime("yyyy yy y MM M dd d HH H hh h mm m ss s SS S A a T")\')',
];

$dpd['Date']['mock_random_now( unit?, format? )'] = [
    '// Ranndom.now()',
    'mock_random_now()',
    'Mock::mock(\'@now\')',
    'Mock::mock(\'@now()\')',
    '',
    '// Ranndom.now( unit )',
    'mock_random_now(\'year\')',
    'mock_random_now(\'month\')',
    'mock_random_now(\'week\')',
    'mock_random_now(\'day\')',
    'mock_random_now(\'hour\')',
    'mock_random_now(\'minute\')',
    'mock_random_now(\'second\')',
    '',
    '// Ranndom.now( format )',
    'mock_random_now(\'yyyy-MM-dd HH:mm:ss SS\')',
    '',
    '// Ranndom.now( unit, format )',
    'mock_random_now(\'day\', \'yyyy-MM-dd HH:mm:ss SS\')',
];

$dpd['Image']['mock_random_image( size?, background?, foreground?, format?, text? )'] = [
    '// mock_random_image()',
    'mock_random_image()',
    '// mock_random_image( size )',
    'mock_random_image(\'200x100\')',
    '// mock_random_image( size, background )',
    'mock_random_image(\'200x100\', \'#FF6600\')',
    '// mock_random_image( size, background, text )',
    'mock_random_image(\'200x100\', \'#4A7BF7\', \'Hello\')',
    '// mock_random_image( size, background, foreground, text )',
    'mock_random_image(\'200x100\', \'#50B347\', \'#FFF\', \'Mock.js\')',
    '// mock_random_image( size, background, foreground, format, text )',
    'mock_random_image(\'200x100\', \'#894FC4\', \'#FFF\', \'png\', \'!\')'
];

$dpd['Image']['mock_random_dataImage( size?, text? )'] = [
    '// mock_random_dataImage()',
    'mock_random_dataImage()',
    '',
    '// mock_random_dataImage( size )',
    'mock_random_dataImage(\'200x100\')',
    '',
    '// mock_random_dataImage( size, text )',
    'mock_random_dataImage(\'200x100\', \'Hello Mock.js!\')',
];

$dpd['Color']['mock_random_color()'] = [
    '// mock_random_color()',
    'mock_random_color()',
    'Mock::mock(\'@color\')',
    'Mock::mock(\'@color()\')'
];

$dpd['Color']['mock_random_hex()'] = [
    '// mock_random_hex()',
    'mock_random_hex()',
    'Mock::mock(\'@hex\')',
    'Mock::mock(\'@hex()\')'
];

$dpd['Color']['mock_random_rgb()'] = [
    '// mock_random_rgb()',
    'mock_random_rgb()',
    'Mock::mock(\'@rgb\')',
    'Mock::mock(\'@rgb()\')'
];

$dpd['Color']['mock_random_rgba()'] = [
    '// mock_random_rgba()',
    'mock_random_rgba()',
    'Mock::mock(\'@rgba\')',
    'Mock::mock(\'@rgba()\')'
];

$dpd['Color']['mock_random_hsl()'] = [
    '// mock_random_hsl()',
    'mock_random_hsl()',
    'Mock::mock(\'@hsl\')',
    'Mock::mock(\'@hsl()\')'
];

$dpd['Text']['mock_random_paragraph( min?, max? )'] = [
    '// mock_random_paragraph()',
    'mock_random_paragraph()',
    '',
    'Mock::mock(\'@paragraph\')',
    '',
    'Mock::mock(\'@paragraph()\')',
    '',
    '// mock_random_paragraph( len )',
    'mock_random_paragraph(2)',
    '',
    'Mock::mock(\'@paragraph(2)\')',
    '',
    '// mock_random_paragraph( min, max )',
    'mock_random_paragraph(1, 3)',
    '',
    'Mock::mock(\'@paragraph(1, 3)\')',
    '',
];

$dpd['Text']['mock_random_sentence( min?, max? )'] = [
    '// mock_random_sentence()',
    'mock_random_sentence()',
    'Mock::mock(\'@sentence\')',
    'Mock::mock(\'@sentence()\')',
    '',
    '// mock_random_sentence( len )',
    'mock_random_sentence(5)',
    'Mock::mock(\'@sentence(5)\')',
    '',
    '// mock_random_sentence( min, max )',
    'mock_random_sentence(3, 5)',
    'Mock::mock(\'@sentence(3, 5)\')',
    ''
];

$dpd['Text']['mock_random_word( min?, max? )'] = [
    '// mock_random_word()',
    'mock_random_word()',
    'Mock::mock(\'@word\')',
    'Mock::mock(\'@word()\')',
    '',
    '// mock_random_word( len )',
    'mock_random_word(5)',
    'Mock::mock(\'@word(5)\')',
    '',
    '// mock_random_word( min, max )',
    'mock_random_word(3, 5)',
    'Mock::mock(\'@word(3, 5)\')',
    ''
];

$dpd['Text']['mock_random_title( min?, max? )'] = [
    '// mock_random_title()',
    'mock_random_title()',
    'Mock::mock(\'@title\')',
    'Mock::mock(\'@title()\')',
    '',
    '// mock_random_title( len )',
    'mock_random_title(5)',
    'Mock::mock(\'@title(5)\')',
    '',
    '// mock_random_title( min, max )',
    'mock_random_title(3, 5)',
    'Mock::mock(\'@title(3, 5)\')',
    ''
];

$dpd['Text']['mock_random_cparagraph( min?, max? )'] = [
    '// mock_random_cparagraph()',
    'mock_random_cparagraph()',
    '',
    'Mock::mock(\'@cparagraph\')',
    '',
    'Mock::mock(\'@cparagraph()\')',
    '',
    '// mock_random_cparagraph( len )',
    'mock_random_cparagraph(2)',
    '',
    'Mock::mock(\'@cparagraph(2)\')',
    '',
    '// mock_random_cparagraph( min, max )',
    'mock_random_cparagraph(1, 3)',
    '',
    'Mock::mock(\'@cparagraph(1, 3)\')',
    '',
];

$dpd['Text']['mock_random_csentence( min?, max? )'] = [
    '// mock_random_csentence()',
    'mock_random_csentence()',
    'Mock::mock(\'@csentence\')',
    'Mock::mock(\'@csentence()\')',
    '',
    '// mock_random_csentence( len )',
    'mock_random_csentence(5)',
    'Mock::mock(\'@csentence(5)\')',
    '',
    '// mock_random_csentence( min, max )',
    'mock_random_csentence(3, 5)',
    'Mock::mock(\'@csentence(3, 5)\')',
    ''
];

$dpd['Text']['mock_random_cword( pool?, min?, max? )'] = [
    '// mock_random_cword()',
    'mock_random_cword()',
    'Mock::mock(\'@cword\')',
    'Mock::mock(\'@cword()\')',
    '',
    '// mock_random_cword( pool )',
    'mock_random_cword(\'零一二三四五六七八九十\')',
    'Mock::mock(\'@cword("零一二三四五六七八九十")\')',
    '',
    '// mock_random_cword( length )',
    'mock_random_cword(3)',
    'Mock::mock(\'@cword(3)\')',
    '',
    '// mock_random_cword( pool, length )',
    'mock_random_cword(\'零一二三四五六七八九十\', 3)',
    'Mock::mock(\'@cword("零一二三四五六七八九十", 3)\')',
    '',
    '// mock_random_cword( min, max )',
    'mock_random_cword(3, 5)',
    'Mock::mock(\'@cword(3, 5)\')',
    '',
    '// mock_random_cword( pool, min, max )',
    'mock_random_cword(\'零一二三四五六七八九十\', 5, 7)',
    'Mock::mock(\'@cword("零一二三四五六七八九十", 5, 7)\')',
];

$dpd['Text']['mock_random_ctitle( min?, max? )'] = [
    '// mock_random_ctitle()',
    'mock_random_ctitle()',
    'Mock::mock(\'@ctitle\')',
    'Mock::mock(\'@ctitle()\')',
    '',
    '// mock_random_ctitle( len )',
    'mock_random_ctitle(5)',
    'Mock::mock(\'@ctitle(5)\')',
    '',
    '// mock_random_ctitle( min, max )',
    'mock_random_ctitle(3, 5)',
    'Mock::mock(\'@ctitle(3, 5)\')',
    ''
];

$dpd['Name']['mock_random_first()'] = [
    '// mock_random_first()',
    'mock_random_first()',
    'Mock::mock(\'@first\')',
    'Mock::mock(\'@first()\')',
];

$dpd['Name']['mock_random_last()'] = [
    '// mock_random_last()',
    'mock_random_last()',
    'Mock::mock(\'@last\')',
    'Mock::mock(\'@last()\')',
];

$dpd['Name']['mock_random_name( middle? )'] = [
    '// mock_random_name()',
    'mock_random_name()',
    'Mock::mock(\'@name\')',
    'Mock::mock(\'@name()\')',
    '',
    '// mock_random_name( middle )',
    'mock_random_name(true)',
    'Mock::mock(\'@name(true)\')',
];

$dpd['Name']['mock_random_cfirst()'] = [
    '// mock_random_cfirst()',
    'mock_random_cfirst()',
    'Mock::mock(\'@cfirst\')',
    'Mock::mock(\'@cfirst()\')',
];

$dpd['Name']['mock_random_clast()'] = [
    '// mock_random_clast()',
    'mock_random_clast()',
    'Mock::mock(\'@clast\')',
    'Mock::mock(\'@clast()\')',
];

$dpd['Name']['mock_random_cname()'] = [
    '// mock_random_cname()',
    'mock_random_cname()',
    'Mock::mock(\'@cname\')',
    'Mock::mock(\'@cname()\')',
];

$dpd['Web']['mock_random_url()'] = [
    '// mock_random_url()',
    'mock_random_url()',
    'Mock::mock(\'@url\')',
    'Mock::mock(\'@url()\')',
];

$dpd['Web']['mock_random_domain()'] = [
    '// mock_random_domain()',
    'mock_random_domain()',
    'Mock::mock(\'@domain\')',
    'Mock::mock(\'@domain()\')',
];
$dpd['Web']['mock_random_domain()'] = [
    '// mock_random_domain()',
    'mock_random_domain()',
    'Mock::mock(\'@domain\')',
    'Mock::mock(\'@domain()\')',
];

$dpd['Web']['mock_random_protocol()'] = [
    '// mock_random_protocol()',
    'mock_random_protocol()',
    'Mock::mock(\'@protocol\')',
    'Mock::mock(\'@protocol()\')',
];

$dpd['Web']['mock_random_tld()'] = [
    '// mock_random_tld()',
    'mock_random_tld()',
    'Mock::mock(\'@tld\')',
    'Mock::mock(\'@tld()\')',
];

$dpd['Web']['mock_random_email()'] = [
    '// mock_random_email()',
    'mock_random_email()',
    'Mock::mock(\'@email\')',
    'Mock::mock(\'@email()\')',
];

$dpd['Web']['mock_random_ip()'] = [
    '// mock_random_ip()',
    'mock_random_ip()',
    'Mock::mock(\'@ip\')',
    'Mock::mock(\'@ip()\')',
];

$dpd['Address']['mock_random_region()'] = [
    '// mock_random_region()',
    'mock_random_region()',
    'Mock::mock(\'@region\')',
    'Mock::mock(\'@region()\')',
];

$dpd['Address']['mock_random_province()'] = [
    '// mock_random_province()',
    'mock_random_province()',
    'Mock::mock(\'@province\')',
    'Mock::mock(\'@province()\')',
];

$dpd['Address']['mock_random_city( prefix? )'] = [
    '// mock_random_city()',
    'mock_random_city()',
    'Mock::mock(\'@city\')',
    'Mock::mock(\'@city()\')',
    '// mock_random_city( prefix )',
    'mock_random_city(true)',
    'Mock::mock(\'@city(true)\')',
];

$dpd['Address']['mock_random_county( prefix? )'] = [
    '// mock_random_county()',
    'mock_random_county()',
    'Mock::mock(\'@county\')',
    'Mock::mock(\'@county()\')',
    '// mock_random_county( prefix )',
    'mock_random_county(true)',
    'Mock::mock(\'@county(true)\')',
];

$dpd['Address']['mock_random_zip()'] = [
    '// mock_random_zip()',
    'mock_random_zip()',
    'Mock::mock(\'@zip\')',
    'Mock::mock(\'@zip()\')',
];

$dpd['Helper']['mock_random_capitalize( word )'] = [
    '// mock_random_capitalize( word )',
    'mock_random_capitalize(\'hello\')',
    'Mock::mock(\'@capitalize("hello")\')',
];

$dpd['Helper']['mock_random_upper( str )'] = [
    '// mock_random_upper( str )',
    'mock_random_upper(\'hello\')',
    'Mock::mock(\'@upper("hello")\')',
];

$dpd['Helper']['mock_random_lower( str )'] = [
    '// mock_random_lower( str )',
    'mock_random_lower(\'HELLO\')',
    'Mock::mock(\'@lower("HELLO")\')',
];

$dpd['Helper']['mock_random_pick( arr )'] = [
    '// mock_random_pick( arr )',
    'mock_random_pick([\'a\', \'e\', \'i\', \'o\', \'u\'])',
    'Mock::mock(\'@pick(["a", "e", "i", "o", "u"])\')',
];

$dpd['Helper']['mock_random_shuffle( arr )'] = [
    '// mock_random_shuffle( arr )',
    'mock_random_shuffle([\'a\', \'e\', \'i\', \'o\', \'u\'])',
    'Mock::mock(\'@shuffle(["a", "e", "i", "o", "u"])\')',
];

$dpd['Miscellaneous']['mock_random_guid()'] = [
    '// mock_random_guid()',
    'mock_random_guid()',
    'Mock::mock(\'@guid\')',
    'Mock::mock(\'@guid()\')',
];

$dpd['Miscellaneous']['mock_random_id()'] = [
    '// mock_random_id()',
    'mock_random_id()',
    'Mock::mock(\'@id\')',
    'Mock::mock(\'@id()\')',
];

$dpd['Miscellaneous']['mock_random_increment( step? )'] = [
    '// mock_random_increment()',
    'mock_random_increment()',
    'Mock::mock(\'@increment\')',
    'Mock::mock(\'@increment()\')',
    '',
    '// mock_random_increment( step )',
    'mock_random_increment(100)',
    'Mock::mock(\'@increment(100)\')',
    'mock_random_increment(1000)',
    'Mock::mock(\'@increment(1000)\')',
];

return $dpd;