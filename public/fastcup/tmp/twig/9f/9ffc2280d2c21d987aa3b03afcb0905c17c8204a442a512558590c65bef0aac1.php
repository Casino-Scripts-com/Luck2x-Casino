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

/* table/search/table_header.twig */
class __TwigTemplate_abd298114c48f92dbfe6b0618aa3810143feebb923d7ab6042e8fa2dc3d9fed2 extends \Twig\Template
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
        echo "<thead>
    <tr>
        ";
        // line 3
        if (($context["geom_column_flag"] ?? null)) {
            // line 4
            echo "            <th>";
            echo _gettext("Function");
            echo "</th>
        ";
        }
        // line 6
        echo "        <th>";
        echo _gettext("Column");
        echo "</th>
        <th>";
        // line 7
        echo _gettext("Type");
        echo "</th>
        <th>";
        // line 8
        echo _gettext("Collation");
        echo "</th>
        <th>";
        // line 9
        echo _gettext("Operator");
        echo "</th>
        <th>";
        // line 10
        echo _gettext("Value");
        echo "</th>
    </tr>
</thead>
";
    }

    public function getTemplateName()
    {
        return "table/search/table_header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 10,  55 => 9,  51 => 8,  47 => 7,  42 => 6,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "table/search/table_header.twig", "/usr/share/phpmyadmin/templates/table/search/table_header.twig");
    }
}
