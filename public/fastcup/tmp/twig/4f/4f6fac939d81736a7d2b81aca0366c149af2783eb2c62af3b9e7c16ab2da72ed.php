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

/* table/search/input_box.twig */
class __TwigTemplate_31494373b7efdfad7217efa36a8ca71fa68fc7e1fcaec5a19d24708d587a67f0 extends \Twig\Template
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
        if ((($context["foreigners"] ?? null) && call_user_func_array($this->env->getFunction('Relation_searchColumnInForeigners')->getCallable(), [($context["foreigners"] ?? null), ($context["column_name"] ?? null)]))) {
            // line 3
            echo "    ";
            if (twig_test_iterable($this->getAttribute(($context["foreign_data"] ?? null), "disp_row", [], "array"))) {
                // line 4
                echo "        <select name=\"criteriaValues[";
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "]\"
            id=\"";
                // line 5
                echo twig_escape_filter($this->env, ($context["column_id"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "\">
            ";
                // line 6
                echo call_user_func_array($this->env->getFunction('Relation_foreignDropdown')->getCallable(), [$this->getAttribute(                // line 7
($context["foreign_data"] ?? null), "disp_row", [], "array"), $this->getAttribute(                // line 8
($context["foreign_data"] ?? null), "foreign_field", [], "array"), $this->getAttribute(                // line 9
($context["foreign_data"] ?? null), "foreign_display", [], "array"), "",                 // line 11
($context["foreign_max_limit"] ?? null)]);
                // line 12
                echo "
        </select>
    ";
            } elseif (($this->getAttribute(            // line 14
($context["foreign_data"] ?? null), "foreign_link", [], "array") == true)) {
                // line 15
                echo "        <input type=\"text\"
            id=\"";
                // line 16
                echo twig_escape_filter($this->env, ($context["column_id"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "\"
            name=\"criteriaValues[";
                // line 17
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "]\"
            id=\"field_";
                // line 18
                echo twig_escape_filter($this->env, ($context["column_name_hash"] ?? null), "html", null, true);
                echo "[";
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "]\"
            class=\"textfield\"
            ";
                // line 20
                if ($this->getAttribute(($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array", true, true)) {
                    // line 21
                    echo "                value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute(($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array"), "html", null, true);
                    echo "\"
            ";
                }
                // line 22
                echo " />
        <a class=\"ajax browse_foreign\" href=\"browse_foreigners.php\" data-post=\"";
                // line 24
                echo PhpMyAdmin\Url::getCommon(["db" => ($context["db"] ?? null), "table" => ($context["table"] ?? null)], "");
                // line 25
                echo "&amp;field=";
                echo twig_escape_filter($this->env, twig_urlencode_filter(($context["column_name"] ?? null)), "html", null, true);
                echo "&amp;fieldkey=";
                // line 26
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "&amp;fromsearch=1\">
            ";
                // line 27
                echo twig_replace_filter($this->getAttribute(($context["titles"] ?? null), "Browse", [], "array"), ["'" => "\\'"]);
                echo "
        </a>
    ";
            }
        } elseif (twig_in_filter(        // line 30
($context["column_type"] ?? null), PhpMyAdmin\Util::getGISDatatypes())) {
            // line 31
            echo "    <input type=\"text\"
        name=\"criteriaValues[";
            // line 32
            echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
            echo "]\"
        size=\"40\"
        class=\"textfield\"
        id=\"field_";
            // line 35
            echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
            echo "\" />
    ";
            // line 36
            if (($context["in_fbs"] ?? null)) {
                // line 37
                echo "        ";
                $context["edit_url"] = ("gis_data_editor.php" . PhpMyAdmin\Url::getCommon());
                // line 38
                echo "        ";
                $context["edit_str"] = PhpMyAdmin\Util::getIcon("b_edit", _gettext("Edit/Insert"));
                // line 39
                echo "        <span class=\"open_search_gis_editor\">
            ";
                // line 40
                echo PhpMyAdmin\Util::linkOrButton(($context["edit_url"] ?? null), ($context["edit_str"] ?? null), [], "_blank");
                echo "
        </span>
    ";
            }
        } elseif (((is_string($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =         // line 43
($context["column_type"] ?? null)) && is_string($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = "enum") && ('' === $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 || 0 === strpos($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4, $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144))) || ((is_string($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b =         // line 44
($context["column_type"] ?? null)) && is_string($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = "set") && ('' === $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 || 0 === strpos($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b, $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002))) && ($context["in_zoom_search_edit"] ?? null)))) {
            // line 45
            echo "    ";
            $context["in_zoom_search_edit"] = false;
            // line 46
            echo "    ";
            $context["value"] = twig_split_filter($this->env, twig_replace_filter(twig_slice($this->env, twig_escape_filter($this->env, ($context["column_type"] ?? null)), 5,  -1), ["&#039;" => ""]), ", ");
            // line 47
            echo "    ";
            $context["cnt_value"] = twig_length_filter($this->env, ($context["value"] ?? null));
            // line 48
            echo "    ";
            // line 54
            echo "    ";
            if ((((is_string($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["column_type"] ?? null)) && is_string($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = "enum") && ('' === $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 || 0 === strpos($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4, $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666))) &&  !($context["in_zoom_search_edit"] ?? null)) || ((is_string($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e =             // line 55
($context["column_type"] ?? null)) && is_string($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = "set") && ('' === $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 || 0 === strpos($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e, $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52))) && ($context["in_zoom_search_edit"] ?? null)))) {
                // line 56
                echo "        <select name=\"criteriaValues[";
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "]\"
            id=\"";
                // line 57
                echo twig_escape_filter($this->env, ($context["column_id"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "\">
    ";
            } else {
                // line 59
                echo "        <select name=\"criteriaValues[";
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "]\"
            id=\"";
                // line 60
                echo twig_escape_filter($this->env, ($context["column_id"] ?? null), "html", null, true);
                echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
                echo "\"
            multiple=\"multiple\"
            size=\"";
                // line 62
                echo twig_escape_filter($this->env, min(3, ($context["cnt_value"] ?? null)), "html", null, true);
                echo "\">
    ";
            }
            // line 64
            echo "    ";
            // line 65
            echo "    <option value=\"\"></option>
    ";
            // line 66
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(0, (($context["cnt_value"] ?? null) - 1)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 67
                echo "        ";
                if ((($this->getAttribute(($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array", true, true) && twig_test_iterable($this->getAttribute(                // line 68
($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array"))) && twig_in_filter($this->getAttribute(                // line 69
($context["value"] ?? null), $context["i"], [], "array"), $this->getAttribute(($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array")))) {
                    // line 70
                    echo "            <option value=\"";
                    echo $this->getAttribute(($context["value"] ?? null), $context["i"], [], "array");
                    echo "\" selected>
                ";
                    // line 71
                    echo $this->getAttribute(($context["value"] ?? null), $context["i"], [], "array");
                    echo "
            </option>
        ";
                } else {
                    // line 74
                    echo "            <option value=\"";
                    echo $this->getAttribute(($context["value"] ?? null), $context["i"], [], "array");
                    echo "\">
                ";
                    // line 75
                    echo $this->getAttribute(($context["value"] ?? null), $context["i"], [], "array");
                    echo "
            </option>
        ";
                }
                // line 78
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 79
            echo "    </select>
";
        } else {
            // line 81
            echo "    ";
            $context["the_class"] = "textfield";
            // line 82
            echo "    ";
            if ((($context["column_type"] ?? null) == "date")) {
                // line 83
                echo "        ";
                $context["the_class"] = (($context["the_class"] ?? null) . " datefield");
                // line 84
                echo "    ";
            } elseif (((($context["column_type"] ?? null) == "datetime") || (is_string($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = ($context["column_type"] ?? null)) && is_string($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = "timestamp") && ('' === $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 || 0 === strpos($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136, $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386))))) {
                // line 85
                echo "        ";
                $context["the_class"] = (($context["the_class"] ?? null) . " datetimefield");
                // line 86
                echo "    ";
            } elseif ((is_string($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = ($context["column_type"] ?? null)) && is_string($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = "bit") && ('' === $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae || 0 === strpos($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9, $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae)))) {
                // line 87
                echo "        ";
                $context["the_class"] = (($context["the_class"] ?? null) . " bit");
                // line 88
                echo "    ";
            }
            // line 89
            echo "    <input type=\"text\"
        name=\"criteriaValues[";
            // line 90
            echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
            echo "]\"
        size=\"40\"
        class=\"";
            // line 92
            echo twig_escape_filter($this->env, ($context["the_class"] ?? null), "html", null, true);
            echo "\"
        id=\"";
            // line 93
            echo twig_escape_filter($this->env, ($context["column_id"] ?? null), "html", null, true);
            echo twig_escape_filter($this->env, ($context["column_index"] ?? null), "html", null, true);
            echo "\"
        ";
            // line 94
            if ($this->getAttribute(($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array", true, true)) {
                // line 95
                echo "           value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute(($context["criteria_values"] ?? null), ($context["column_index"] ?? null), [], "array"), "html", null, true);
                echo "\"";
            }
            // line 96
            echo " />
";
        }
    }

    public function getTemplateName()
    {
        return "table/search/input_box.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  274 => 96,  269 => 95,  267 => 94,  262 => 93,  258 => 92,  253 => 90,  250 => 89,  247 => 88,  244 => 87,  241 => 86,  238 => 85,  235 => 84,  232 => 83,  229 => 82,  226 => 81,  222 => 79,  216 => 78,  210 => 75,  205 => 74,  199 => 71,  194 => 70,  192 => 69,  191 => 68,  189 => 67,  185 => 66,  182 => 65,  180 => 64,  175 => 62,  169 => 60,  164 => 59,  158 => 57,  153 => 56,  151 => 55,  149 => 54,  147 => 48,  144 => 47,  141 => 46,  138 => 45,  136 => 44,  135 => 43,  129 => 40,  126 => 39,  123 => 38,  120 => 37,  118 => 36,  114 => 35,  108 => 32,  105 => 31,  103 => 30,  97 => 27,  93 => 26,  89 => 25,  87 => 24,  84 => 22,  78 => 21,  76 => 20,  69 => 18,  65 => 17,  60 => 16,  57 => 15,  55 => 14,  51 => 12,  49 => 11,  48 => 9,  47 => 8,  46 => 7,  45 => 6,  40 => 5,  35 => 4,  32 => 3,  30 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table/search/input_box.twig", "/usr/share/phpmyadmin/templates/table/search/input_box.twig");
    }
}
