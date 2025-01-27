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

/* table/search/rows_normal.twig */
class __TwigTemplate_68c405e453ed1b96dc1d327ad3cd89d4bc29eb58eb1096115507bed6b2e9e0bc extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(0, (twig_length_filter($this->env, ($context["column_names"] ?? null)) - 1)));
        foreach ($context['_seq'] as $context["_key"] => $context["column_index"]) {
            // line 2
            echo "    <tr class=\"noclick\">
        ";
            // line 4
            echo "        ";
            if (($context["geom_column_flag"] ?? null)) {
                // line 5
                echo "            ";
                $this->loadTemplate("table/search/geom_func.twig", "table/search/rows_normal.twig", 5)->display(twig_to_array(["column_index" =>                 // line 6
$context["column_index"], "column_types" =>                 // line 7
($context["column_types"] ?? null)]));
                // line 9
                echo "        ";
            }
            // line 10
            echo "        ";
            // line 11
            echo "        <th>
            ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute(($context["column_names"] ?? null), $context["column_index"], [], "array"), "html", null, true);
            echo "
        </th>
        ";
            // line 14
            $context["properties"] = $this->getAttribute(($context["self"] ?? null), "getColumnProperties", [0 => $context["column_index"], 1 => $context["column_index"]], "method");
            // line 15
            echo "        <td dir=\"ltr\">
            ";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute(($context["properties"] ?? null), "type", [], "array"), "html", null, true);
            echo "
        </td>
        <td>
            ";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute(($context["properties"] ?? null), "collation", [], "array"), "html", null, true);
            echo "
        </td>
        <td>
            ";
            // line 22
            echo $this->getAttribute(($context["properties"] ?? null), "func", [], "array");
            echo "
        </td>
        ";
            // line 25
            echo "        <td data-type=\"";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["properties"] ?? null), "type", [], "array"), "html", null, true);
            echo "\">
            ";
            // line 26
            echo $this->getAttribute(($context["properties"] ?? null), "value", [], "array");
            echo "
            ";
            // line 28
            echo "            <input type=\"hidden\"
                name=\"criteriaColumnNames[";
            // line 29
            echo twig_escape_filter($this->env, $context["column_index"], "html", null, true);
            echo "]\"
                value=\"";
            // line 30
            echo twig_escape_filter($this->env, $this->getAttribute(($context["column_names"] ?? null), $context["column_index"], [], "array"), "html", null, true);
            echo "\" />
            <input type=\"hidden\"
                name=\"criteriaColumnTypes[";
            // line 32
            echo twig_escape_filter($this->env, $context["column_index"], "html", null, true);
            echo "]\"
                value=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute(($context["column_types"] ?? null), $context["column_index"], [], "array"), "html", null, true);
            echo "\" />
            <input type=\"hidden\"
                name=\"criteriaColumnCollations[";
            // line 35
            echo twig_escape_filter($this->env, $context["column_index"], "html", null, true);
            echo "]\"
                value=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute(($context["column_collations"] ?? null), $context["column_index"], [], "array"), "html", null, true);
            echo "\" />
        </td>
    </tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column_index'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "table/search/rows_normal.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 36,  110 => 35,  105 => 33,  101 => 32,  96 => 30,  92 => 29,  89 => 28,  85 => 26,  80 => 25,  75 => 22,  69 => 19,  63 => 16,  60 => 15,  58 => 14,  53 => 12,  50 => 11,  48 => 10,  45 => 9,  43 => 7,  42 => 6,  40 => 5,  37 => 4,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table/search/rows_normal.twig", "/usr/share/phpmyadmin/templates/table/search/rows_normal.twig");
    }
}
