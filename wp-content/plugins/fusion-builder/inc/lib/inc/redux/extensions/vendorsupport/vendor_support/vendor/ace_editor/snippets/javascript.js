ace.define("ace/snippets/javascript",["require","exports","module"],function(e,t,n){"use strict";t.snippetText='# Prototype\nsnippet proto\n	${1:class_name}.prototype.${2:method_name} = function(${3:first_argument}) {\n		${4:// body...}\n	};\n# Function\nsnippet fun\n	function ${1?:function_name}(${2:argument}) {\n		${3:// body...}\n	}\n# Anonymous Function\nregex /((=)\\s*|(:)\\s*|(\\()|\\b)/f/(\\))?/\nsnippet f\n	function${M1?: ${1:functionName}}($2) {\n		${0:$TM_SELECTED_TEXT}\n	}${M2?;}${M3?,}${M4?)}\n# Immediate function\ntrigger \\(?f\\(\nendTrigger \\)?\nsnippet f(\n	(function(${1}) {\n		${0:${TM_SELECTED_TEXT:/* code */}}\n	}(${1}));\n# if\nsnippet if\n	if (${1:true}) {\n		${0}\n	}\n# if ... else\nsnippet ife\n	if (${1:true}) {\n		${2}\n	} else {\n		${0}\n	}\n# tertiary conditional\nsnippet ter\n	${1:/* condition */} ? ${2:a} : ${3:b}\n# switch\nsnippet switch\n	switch (${1:expression}) {\n		case \'${3:case}\':\n			${4:// code}\n			break;\n		${5}\n		default:\n			${2:// code}\n	}\n# case\nsnippet case\n	case \'${1:case}\':\n		${2:// code}\n		break;\n	${3}\n\n# while (...) {...}\nsnippet wh\n	while (${1:/* condition */}) {\n		${0:/* code */}\n	}\n# try\nsnippet try\n	try {\n		${0:/* code */}\n	} catch (e) {}\n# do...while\nsnippet do\n	do {\n		${2:/* code */}\n	} while (${1:/* condition */});\n# Object Method\nsnippet :f\nregex /([,{[])|^\\s*/:f/\n	${1:method_name}: function(${2:attribute}) {\n		${0}\n	}${3:,}\n# setTimeout function\nsnippet setTimeout\nregex /\\b/st|timeout|setTimeo?u?t?/\n	setTimeout(function() {${3:$TM_SELECTED_TEXT}}, ${1:10});\n# Get Elements\nsnippet gett\n	getElementsBy${1:TagName}(\'${2}\')${3}\n# Get Element\nsnippet get\n	getElementBy${1:Id}(\'${2}\')${3}\n# console.log (Firebug)\nsnippet cl\n	console.log(${1});\n# return\nsnippet ret\n	return ${1:result}\n# for (property in object ) { ... }\nsnippet fori\n	for (var ${1:prop} in ${2:Things}) {\n		${0:$2[$1]}\n	}\n# hasOwnProperty\nsnippet has\n	hasOwnProperty(${1})\n# docstring\nsnippet /**\nsnippet @par\nregex /^\\s*\\*\\s*/@(para?m?)?/\n	@param {${1:type}} ${2:name} ${3:description}\nsnippet @ret\n	@return {${1:type}} ${2:description}\n# JSON.parse\nsnippet jsonp\n	JSON.parse(${1:jstr});\n# JSON.stringify\nsnippet jsons\n	JSON.stringify(${1:object});\n# self-defining function\nsnippet sdf\n	var ${1:function_name} = function(${2:argument}) {\n		${3:// initial code ...}\n\n		$1 = function($2) {\n			${4:// main code}\n		};\n	}\n# singleton\nsnippet sing\n	function ${1:Singleton} (${2:argument}) {\n		var instance;\n		$1 = function $1($2) {\n			return instance;\n		};\n		$1.prototype = this;\n		instance = new $1();\n		instance.constructor = $1;\n\n		${3:// code ...}\n\n		return instance;\n	}\n# class\nsnippet class\nregex /^\\s*/clas{0,2}/\n	var ${1:class} = function(${20}) {\n		$40$0\n	};\n	\n	(function() {\n		${60:this.prop = ""}\n	}).call(${1:class}.prototype);\n	\n	exports.${1:class} = ${1:class};\n# \nsnippet for-\n	for (var ${1:i} = ${2:Things}.length; ${1:i}--; ) {\n		${0:${2:Things}[${1:i}];}\n	}\n# for (...) {...}\nsnippet for\n	for (var ${1:i} = 0; $1 < ${2:Things}.length; $1++) {\n		${3:$2[$1]}$0\n	}\n# for (...) {...} (Improved Native For-Loop)\nsnippet forr\n	for (var ${1:i} = ${2:Things}.length - 1; $1 >= 0; $1--) {\n		${3:$2[$1]}$0\n	}\n\n\n#modules\nsnippet def\n	ace.define(function(require, exports, module) {\n	"use strict";\n	var ${1/.*\\///} = require("${1}");\n	\n	$TM_SELECTED_TEXT\n	});\nsnippet req\nguard ^\\s*\n	var ${1/.*\\///} = require("${1}");\n	$0\nsnippet requ\nguard ^\\s*\n	var ${1/.*\\/(.)/\\u$1/} = require("${1}").${1/.*\\/(.)/\\u$1/};\n	$0\n',t.scope="javascript"});