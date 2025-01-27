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

/* table/search/selection_form.twig */
class __TwigTemplate_63630e51425b4ff51f2b4df73c381ff462c3ad348df597263bafafa33c0f174a extends \Twig\Template
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
        // line 1
        if ((($context["search_type"] ?? null) == "zoom")) {
            // line 2
            echo "    ";
            $this->loadTemplate("table/search/form_tag.twig", "table/search/selection_form.twig", 2)->display(twig_to_array(["script_name" => "tbl_zoom_select.php", "form_id" => "zoom_search_form", "db" =>             // line 5
($context["db"] ?? null), "table" =>             // line 6
($context["table"] ?? null), "goto" =>             // line 7
($context["goto"] ?? null)]));
            // line 9
            echo "    <fieldset id=\"fieldset_zoom_search\">
        <fieldset id=\"inputSection\">
            <legend>
                ";
            // line 12
            echo _gettext("Do a \"query by example\" (wildcard: \"%\") for two different columns");
            // line 13
            echo "            </legend>
            ";
            // line 14
            $this->loadTemplate("table/search/fields_table.twig", "table/search/selection_form.twig", 14)->display(twig_to_array(["self" =>             // line 15
($context["self"] ?? null), "search_type" =>             // line 16
($context["search_type"] ?? null), "geom_column_flag" =>             // line 17
($context["geom_column_flag"] ?? null), "column_names" =>             // line 18
($context["column_names"] ?? null), "column_types" =>             // line 19
($context["column_types"] ?? null), "column_collations" =>             // line 20
($context["column_collations"] ?? null), "criteria_column_names" =>             // line 21
($context["criteria_column_names"] ?? null), "criteria_column_types" =>             // line 22
($context["criteria_column_types"] ?? null)]));
            // line 24
            echo "            ";
            $this->loadTemplate("table/search/options_zoom.twig", "table/search/selection_form.twig", 24)->display(twig_to_array(["data_label" =>             // line 25
($context["data_label"] ?? null), "column_names" =>             // line 26
($context["column_names"] ?? null), "max_plot_limit" =>             // line 27
($context["max_plot_limit"] ?? null)]));
            // line 29
            echo "        </fieldset>
    </fieldset>
";
        } elseif ((        // line 31
($context["search_type"] ?? null) == "normal")) {
            // line 32
            echo "    ";
            $this->loadTemplate("table/search/form_tag.twig", "table/search/selection_form.twig", 32)->display(twig_to_array(["script_name" => "tbl_select.php", "form_id" => "tbl_search_form", "db" =>             // line 35
($context["db"] ?? null), "table" =>             // line 36
($context["table"] ?? null), "goto" =>             // line 37
($context["goto"] ?? null)]));
            // line 39
            echo "    <fieldset id=\"fieldset_table_search\">
        <fieldset id=\"fieldset_table_qbe\">
            <legend>
                ";
            // line 42
            echo _gettext("Do a \"query by example\" (wildcard: \"%\")");
            // line 43
            echo "            </legend>
            <div class=\"responsivetable jsresponsive\">
                ";
            // line 45
            $this->loadTemplate("table/search/fields_table.twig", "table/search/selection_form.twig", 45)->display(twig_to_array(["self" =>             // line 46
($context["self"] ?? null), "search_type" =>             // line 47
($context["search_type"] ?? null), "geom_column_flag" =>             // line 48
($context["geom_column_flag"] ?? null), "column_names" =>             // line 49
($context["column_names"] ?? null), "column_types" =>             // line 50
($context["column_types"] ?? null), "column_collations" =>             // line 51
($context["column_collations"] ?? null), "criteria_column_names" =>             // line 52
($context["criteria_column_names"] ?? null), "criteria_column_types" =>             // line 53
($context["criteria_column_types"] ?? null)]));
            // line 55
            echo "            </div>
            <div id=\"gis_editor\"></div>
            <div id=\"popup_background\"></div>
        </fieldset>
        ";
            // line 59
            $this->loadTemplate("table/search/options.twig", "table/search/selection_form.twig", 59)->display(twig_to_array(["column_names" =>             // line 60
($context["column_names"] ?? null), "max_rows" =>             // line 61
($context["max_rows"] ?? null)]));
            // line 63
            echo "    </fieldset>
";
        } elseif ((        // line 64
($context["search_type"] ?? null) == "replace")) {
            // line 65
            echo "    ";
            $this->loadTemplate("table/search/form_tag.twig", "table/search/selection_form.twig", 65)->display(twig_to_array(["script_name" => "tbl_find_replace.php", "form_id" => "find_replace_form", "db" =>             // line 68
($context["db"] ?? null), "table" =>             // line 69
($context["table"] ?? null), "goto" =>             // line 70
($context["goto"] ?? null)]));
            // line 72
            echo "    <fieldset id=\"fieldset_find_replace\">
        <fieldset id=\"fieldset_find\">
            <legend>
                ";
            // line 75
            echo _gettext("Find and replace");
            // line 76
            echo "            </legend>
            ";
            // line 77
            $this->loadTemplate("table/search/search_and_replace.twig", "table/search/selection_form.twig", 77)->display(twig_to_array(["column_names" =>             // line 78
($context["column_names"] ?? null), "column_types" =>             // line 79
($context["column_types"] ?? null), "sql_types" =>             // line 80
($context["sql_types"] ?? null)]));
            // line 82
            echo "        </fieldset>
    </fieldset>
";
        } else {
            // line 85
            echo "    ";
            $this->loadTemplate("table/search/form_tag.twig", "table/search/selection_form.twig", 85)->display(twig_to_array(["script_name" => "", "form_id" => "", "db" =>             // line 88
($context["db"] ?? null), "table" =>             // line 89
($context["table"] ?? null), "goto" =>             // line 90
($context["goto"] ?? null)]));
        }
        // line 93
        echo "
";
        // line 95
        echo "    <fieldset class=\"tblFooters\">
        <input type=\"submit\"
            name=\"";
        // line 97
        echo (((($context["search_type"] ?? null) == "zoom")) ? ("zoom_submit") : ("submit"));
        echo "\"
            ";
        // line 98
        echo (((($context["search_type"] ?? null) == "zoom")) ? ("id=\"inputFormSubmitId\"") : (""));
        echo "
            value=\"";
        // line 99
        echo _gettext("Go");
        echo "\" />
    </fieldset>
</form>
<div id=\"sqlqueryresultsouter\"></div>
";
    }

    public function getTemplateName()
    {
        return "table/search/selection_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 99,  156 => 98,  152 => 97,  148 => 95,  145 => 93,  142 => 90,  141 => 89,  140 => 88,  138 => 85,  133 => 82,  131 => 80,  130 => 79,  129 => 78,  128 => 77,  125 => 76,  123 => 75,  118 => 72,  116 => 70,  115 => 69,  114 => 68,  112 => 65,  110 => 64,  107 => 63,  105 => 61,  104 => 60,  103 => 59,  97 => 55,  95 => 53,  94 => 52,  93 => 51,  92 => 50,  91 => 49,  90 => 48,  89 => 47,  88 => 46,  87 => 45,  83 => 43,  81 => 42,  76 => 39,  74 => 37,  73 => 36,  72 => 35,  70 => 32,  68 => 31,  64 => 29,  62 => 27,  61 => 26,  60 => 25,  58 => 24,  56 => 22,  55 => 21,  54 => 20,  53 => 19,  52 => 18,  51 => 17,  50 => 16,  49 => 15,  48 => 14,  45 => 13,  43 => 12,  38 => 9,  36 => 7,  35 => 6,  34 => 5,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table/search/selection_form.twig", "/usr/share/phpmyadmin/templates/table/search/selection_form.twig");
    }
}
