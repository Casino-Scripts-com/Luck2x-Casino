<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* columns_definitions/column_attributes.twig */
class __TwigTemplate_eb2efb9bdc148ebedc45b44b65956633f3825d7a7e5b5994aa3d8ffb3721e2e5 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 2
        $context["ci"] = 0;
        // line 3
        echo "
";
        // line 6
        $context["ci_offset"] =  -1;
        // line 7
        echo "
<td class=\"center\">
    ";
        // line 10
        echo "    ";
        $this->loadTemplate("columns_definitions/column_name.twig", "columns_definitions/column_attributes.twig", 10)->display(twig_to_array(["column_number" =>         // line 11
($context["column_number"] ?? null), "ci" =>         // line 12
($context["ci"] ?? null), "ci_offset" =>         // line 13
($context["ci_offset"] ?? null), "column_meta" =>         // line 14
($context["column_meta"] ?? null), "cfg_relation" =>         // line 15
($context["cfg_relation"] ?? null), "max_rows" =>         // line 16
($context["max_rows"] ?? null)]));
        // line 18
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 19
        echo "</td>
<td class=\"center\">
    ";
        // line 22
        echo "    ";
        $this->loadTemplate("columns_definitions/column_type.twig", "columns_definitions/column_attributes.twig", 22)->display(twig_to_array(["column_number" =>         // line 23
($context["column_number"] ?? null), "ci" =>         // line 24
($context["ci"] ?? null), "ci_offset" =>         // line 25
($context["ci_offset"] ?? null), "column_meta" =>         // line 26
($context["column_meta"] ?? null), "type_upper" =>         // line 27
($context["type_upper"] ?? null)]));
        // line 29
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 30
        echo "</td>
<td class=\"center\">
    ";
        // line 33
        echo "    ";
        $this->loadTemplate("columns_definitions/column_length.twig", "columns_definitions/column_attributes.twig", 33)->display(twig_to_array(["column_number" =>         // line 34
($context["column_number"] ?? null), "ci" =>         // line 35
($context["ci"] ?? null), "ci_offset" =>         // line 36
($context["ci_offset"] ?? null), "length_values_input_size" =>         // line 37
($context["length_values_input_size"] ?? null), "length_to_display" =>         // line 38
($context["length"] ?? null)]));
        // line 40
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 41
        echo "</td>
<td class=\"center\">
    ";
        // line 44
        echo "    ";
        $this->loadTemplate("columns_definitions/column_default.twig", "columns_definitions/column_attributes.twig", 44)->display(twig_to_array(["column_number" =>         // line 45
($context["column_number"] ?? null), "ci" =>         // line 46
($context["ci"] ?? null), "ci_offset" =>         // line 47
($context["ci_offset"] ?? null), "column_meta" =>         // line 48
($context["column_meta"] ?? null), "type_upper" =>         // line 49
($context["type_upper"] ?? null), "char_editing" =>         // line 50
($context["char_editing"] ?? null)]));
        // line 52
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 53
        echo "</td>
<td class=\"center\">
    ";
        // line 56
        echo "    ";
        echo PhpMyAdmin\Charsets::getCollationDropdownBox(        // line 57
($context["dbi"] ?? null),         // line 58
($context["disable_is"] ?? null), (("field_collation[" .         // line 59
($context["column_number"] ?? null)) . "]"), ((("field_" .         // line 60
($context["column_number"] ?? null)) . "_") . (($context["ci"] ?? null) - ($context["ci_offset"] ?? null))), (( !twig_test_empty($this->getAttribute(        // line 61
($context["column_meta"] ?? null), "Collation", [], "array"))) ? ($this->getAttribute(($context["column_meta"] ?? null), "Collation", [], "array")) : (null)), false);
        // line 63
        echo "
    ";
        // line 64
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 65
        echo "</td>
<td class=\"center\">
    ";
        // line 68
        echo "    ";
        $this->loadTemplate("columns_definitions/column_attribute.twig", "columns_definitions/column_attributes.twig", 68)->display(twig_to_array(["column_number" =>         // line 69
($context["column_number"] ?? null), "ci" =>         // line 70
($context["ci"] ?? null), "ci_offset" =>         // line 71
($context["ci_offset"] ?? null), "column_meta" =>         // line 72
($context["column_meta"] ?? null), "extracted_columnspec" =>         // line 73
($context["extracted_columnspec"] ?? null), "submit_attribute" =>         // line 74
($context["submit_attribute"] ?? null), "attribute_types" =>         // line 75
($context["attribute_types"] ?? null)]));
        // line 77
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 78
        echo "</td>
<td class=\"center\">
    ";
        // line 81
        echo "    ";
        $this->loadTemplate("columns_definitions/column_null.twig", "columns_definitions/column_attributes.twig", 81)->display(twig_to_array(["column_number" =>         // line 82
($context["column_number"] ?? null), "ci" =>         // line 83
($context["ci"] ?? null), "ci_offset" =>         // line 84
($context["ci_offset"] ?? null), "column_meta" =>         // line 85
($context["column_meta"] ?? null)]));
        // line 87
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 88
        echo "</td>
";
        // line 89
        if (((isset($context["change_column"]) || array_key_exists("change_column", $context)) &&  !twig_test_empty(($context["change_column"] ?? null)))) {
            // line 90
            echo "    ";
            // line 91
            echo "    <td class=\"center\">
        ";
            // line 92
            $this->loadTemplate("columns_definitions/column_adjust_privileges.twig", "columns_definitions/column_attributes.twig", 92)->display(twig_to_array(["column_number" =>             // line 93
($context["column_number"] ?? null), "ci" =>             // line 94
($context["ci"] ?? null), "ci_offset" =>             // line 95
($context["ci_offset"] ?? null), "privs_available" =>             // line 96
($context["privs_available"] ?? null)]));
            // line 98
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 99
            echo "    </td>
";
        }
        // line 101
        if ( !($context["is_backup"] ?? null)) {
            // line 102
            echo "    ";
            // line 103
            echo "    <td class=\"center\">
        ";
            // line 104
            $this->loadTemplate("columns_definitions/column_indexes.twig", "columns_definitions/column_attributes.twig", 104)->display(twig_to_array(["column_number" =>             // line 105
($context["column_number"] ?? null), "ci" =>             // line 106
($context["ci"] ?? null), "ci_offset" =>             // line 107
($context["ci_offset"] ?? null), "column_meta" =>             // line 108
($context["column_meta"] ?? null)]));
            // line 110
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 111
            echo "    </td>
";
        }
        // line 113
        echo "<td class=\"center\">
    ";
        // line 115
        echo "    ";
        $this->loadTemplate("columns_definitions/column_auto_increment.twig", "columns_definitions/column_attributes.twig", 115)->display(twig_to_array(["column_number" =>         // line 116
($context["column_number"] ?? null), "ci" =>         // line 117
($context["ci"] ?? null), "ci_offset" =>         // line 118
($context["ci_offset"] ?? null), "column_meta" =>         // line 119
($context["column_meta"] ?? null)]));
        // line 121
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 122
        echo "</td>
<td class=\"center\">
    ";
        // line 125
        echo "    ";
        $this->loadTemplate("columns_definitions/column_comment.twig", "columns_definitions/column_attributes.twig", 125)->display(twig_to_array(["column_number" =>         // line 126
($context["column_number"] ?? null), "ci" =>         // line 127
($context["ci"] ?? null), "ci_offset" =>         // line 128
($context["ci_offset"] ?? null), "max_length" =>         // line 129
($context["max_length"] ?? null), "value" => (((($this->getAttribute(        // line 130
($context["column_meta"] ?? null), "Field", [], "array", true, true) && twig_test_iterable(        // line 131
($context["comments_map"] ?? null))) && $this->getAttribute(        // line 132
($context["comments_map"] ?? null), $this->getAttribute(($context["column_meta"] ?? null), "Field", [], "array"), [], "array", true, true))) ? (twig_escape_filter($this->env, $this->getAttribute(        // line 133
($context["comments_map"] ?? null), $this->getAttribute(($context["column_meta"] ?? null), "Field", [], "array"), [], "array"))) : (""))]));
        // line 135
        echo "    ";
        $context["ci"] = (($context["ci"] ?? null) + 1);
        // line 136
        echo "</td>
 ";
        // line 138
        if (($context["is_virtual_columns_supported"] ?? null)) {
            // line 139
            echo "    <td class=\"center\">
        ";
            // line 140
            $this->loadTemplate("columns_definitions/column_virtuality.twig", "columns_definitions/column_attributes.twig", 140)->display(twig_to_array(["column_number" =>             // line 141
($context["column_number"] ?? null), "ci" =>             // line 142
($context["ci"] ?? null), "ci_offset" =>             // line 143
($context["ci_offset"] ?? null), "column_meta" =>             // line 144
($context["column_meta"] ?? null), "char_editing" =>             // line 145
($context["char_editing"] ?? null), "expression" => (($this->getAttribute(            // line 146
($context["column_meta"] ?? null), "Expression", [], "array", true, true)) ? ($this->getAttribute(($context["column_meta"] ?? null), "Expression", [], "array")) : ("")), "options" =>             // line 147
($context["options"] ?? null)]));
            // line 149
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 150
            echo "    </td>
";
        }
        // line 153
        if ((isset($context["fields_meta"]) || array_key_exists("fields_meta", $context))) {
            // line 154
            echo "    ";
            $context["current_index"] = 0;
            // line 155
            echo "    ";
            $context["cols"] = (twig_length_filter($this->env, ($context["move_columns"] ?? null)) - 1);
            // line 156
            echo "    ";
            $context["break"] = false;
            // line 157
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(0, ($context["cols"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["mi"]) {
                if ((($this->getAttribute($this->getAttribute(($context["move_columns"] ?? null), $context["mi"], [], "array"), "name", []) == $this->getAttribute(($context["column_meta"] ?? null), "Field", [], "array")) &&  !($context["break"] ?? null))) {
                    // line 158
                    echo "        ";
                    $context["current_index"] = $context["mi"];
                    // line 159
                    echo "        ";
                    $context["break"] = true;
                    // line 160
                    echo "    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mi'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 161
            echo "
    <td class=\"center\">
        ";
            // line 163
            $this->loadTemplate("columns_definitions/move_column.twig", "columns_definitions/column_attributes.twig", 163)->display(twig_to_array(["column_number" =>             // line 164
($context["column_number"] ?? null), "ci" =>             // line 165
($context["ci"] ?? null), "ci_offset" =>             // line 166
($context["ci_offset"] ?? null), "column_meta" =>             // line 167
($context["column_meta"] ?? null), "move_columns" =>             // line 168
($context["move_columns"] ?? null), "current_index" =>             // line 169
($context["current_index"] ?? null)]));
            // line 171
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 172
            echo "    </td>
";
        }
        // line 174
        echo "
";
        // line 175
        if ((($this->getAttribute(($context["cfg_relation"] ?? null), "mimework", [], "array") && ($context["browse_mime"] ?? null)) && $this->getAttribute(($context["cfg_relation"] ?? null), "commwork", [], "array"))) {
            // line 176
            echo "    <td class=\"center\">
        ";
            // line 178
            echo "        ";
            $this->loadTemplate("columns_definitions/mime_type.twig", "columns_definitions/column_attributes.twig", 178)->display(twig_to_array(["column_number" =>             // line 179
($context["column_number"] ?? null), "ci" =>             // line 180
($context["ci"] ?? null), "ci_offset" =>             // line 181
($context["ci_offset"] ?? null), "column_meta" =>             // line 182
($context["column_meta"] ?? null), "available_mime" =>             // line 183
($context["available_mime"] ?? null), "mime_map" =>             // line 184
($context["mime_map"] ?? null)]));
            // line 186
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 187
            echo "    </td>
    <td class=\"center\">
        ";
            // line 190
            echo "        ";
            $this->loadTemplate("columns_definitions/transformation.twig", "columns_definitions/column_attributes.twig", 190)->display(twig_to_array(["column_number" =>             // line 191
($context["column_number"] ?? null), "ci" =>             // line 192
($context["ci"] ?? null), "ci_offset" =>             // line 193
($context["ci_offset"] ?? null), "column_meta" =>             // line 194
($context["column_meta"] ?? null), "available_mime" =>             // line 195
($context["available_mime"] ?? null), "mime_map" =>             // line 196
($context["mime_map"] ?? null), "type" => "transformation"]));
            // line 199
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 200
            echo "    </td>
    <td class=\"center\">
        ";
            // line 203
            echo "        ";
            $this->loadTemplate("columns_definitions/transformation_option.twig", "columns_definitions/column_attributes.twig", 203)->display(twig_to_array(["column_number" =>             // line 204
($context["column_number"] ?? null), "ci" =>             // line 205
($context["ci"] ?? null), "ci_offset" =>             // line 206
($context["ci_offset"] ?? null), "column_meta" =>             // line 207
($context["column_meta"] ?? null), "mime_map" =>             // line 208
($context["mime_map"] ?? null), "type_prefix" => ""]));
            // line 211
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 212
            echo "    </td>
    <td class=\"center\">
        ";
            // line 215
            echo "        ";
            $this->loadTemplate("columns_definitions/transformation.twig", "columns_definitions/column_attributes.twig", 215)->display(twig_to_array(["column_number" =>             // line 216
($context["column_number"] ?? null), "ci" =>             // line 217
($context["ci"] ?? null), "ci_offset" =>             // line 218
($context["ci_offset"] ?? null), "column_meta" =>             // line 219
($context["column_meta"] ?? null), "available_mime" =>             // line 220
($context["available_mime"] ?? null), "mime_map" =>             // line 221
($context["mime_map"] ?? null), "type" => "input_transformation"]));
            // line 224
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 225
            echo "    </td>
    <td class=\"center\">
        ";
            // line 228
            echo "        ";
            $this->loadTemplate("columns_definitions/transformation_option.twig", "columns_definitions/column_attributes.twig", 228)->display(twig_to_array(["column_number" =>             // line 229
($context["column_number"] ?? null), "ci" =>             // line 230
($context["ci"] ?? null), "ci_offset" =>             // line 231
($context["ci_offset"] ?? null), "column_meta" =>             // line 232
($context["column_meta"] ?? null), "mime_map" =>             // line 233
($context["mime_map"] ?? null), "type_prefix" => "input_"]));
            // line 236
            echo "        ";
            $context["ci"] = (($context["ci"] ?? null) + 1);
            // line 237
            echo "    </td>
";
        }
    }

    public function getTemplateName()
    {
        return "columns_definitions/column_attributes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  376 => 237,  373 => 236,  371 => 233,  370 => 232,  369 => 231,  368 => 230,  367 => 229,  365 => 228,  361 => 225,  358 => 224,  356 => 221,  355 => 220,  354 => 219,  353 => 218,  352 => 217,  351 => 216,  349 => 215,  345 => 212,  342 => 211,  340 => 208,  339 => 207,  338 => 206,  337 => 205,  336 => 204,  334 => 203,  330 => 200,  327 => 199,  325 => 196,  324 => 195,  323 => 194,  322 => 193,  321 => 192,  320 => 191,  318 => 190,  314 => 187,  311 => 186,  309 => 184,  308 => 183,  307 => 182,  306 => 181,  305 => 180,  304 => 179,  302 => 178,  299 => 176,  297 => 175,  294 => 174,  290 => 172,  287 => 171,  285 => 169,  284 => 168,  283 => 167,  282 => 166,  281 => 165,  280 => 164,  279 => 163,  275 => 161,  268 => 160,  265 => 159,  262 => 158,  256 => 157,  253 => 156,  250 => 155,  247 => 154,  245 => 153,  241 => 150,  238 => 149,  236 => 147,  235 => 146,  234 => 145,  233 => 144,  232 => 143,  231 => 142,  230 => 141,  229 => 140,  226 => 139,  224 => 138,  221 => 136,  218 => 135,  216 => 133,  215 => 132,  214 => 131,  213 => 130,  212 => 129,  211 => 128,  210 => 127,  209 => 126,  207 => 125,  203 => 122,  200 => 121,  198 => 119,  197 => 118,  196 => 117,  195 => 116,  193 => 115,  190 => 113,  186 => 111,  183 => 110,  181 => 108,  180 => 107,  179 => 106,  178 => 105,  177 => 104,  174 => 103,  172 => 102,  170 => 101,  166 => 99,  163 => 98,  161 => 96,  160 => 95,  159 => 94,  158 => 93,  157 => 92,  154 => 91,  152 => 90,  150 => 89,  147 => 88,  144 => 87,  142 => 85,  141 => 84,  140 => 83,  139 => 82,  137 => 81,  133 => 78,  130 => 77,  128 => 75,  127 => 74,  126 => 73,  125 => 72,  124 => 71,  123 => 70,  122 => 69,  120 => 68,  116 => 65,  114 => 64,  111 => 63,  109 => 61,  108 => 60,  107 => 59,  106 => 58,  105 => 57,  103 => 56,  99 => 53,  96 => 52,  94 => 50,  93 => 49,  92 => 48,  91 => 47,  90 => 46,  89 => 45,  87 => 44,  83 => 41,  80 => 40,  78 => 38,  77 => 37,  76 => 36,  75 => 35,  74 => 34,  72 => 33,  68 => 30,  65 => 29,  63 => 27,  62 => 26,  61 => 25,  60 => 24,  59 => 23,  57 => 22,  53 => 19,  50 => 18,  48 => 16,  47 => 15,  46 => 14,  45 => 13,  44 => 12,  43 => 11,  41 => 10,  37 => 7,  35 => 6,  32 => 3,  30 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "columns_definitions/column_attributes.twig", "/usr/share/phpmyadmin/templates/columns_definitions/column_attributes.twig");
    }
}
