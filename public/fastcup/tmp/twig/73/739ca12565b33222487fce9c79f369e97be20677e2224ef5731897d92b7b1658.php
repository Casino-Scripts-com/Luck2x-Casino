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

/* columns_definitions/transformation_option.twig */
class __TwigTemplate_6a3bd96171a39cf3df429f95dccd7a11b7c6858279677e7e56bab9cde37370ba extends \Twig\Template
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
        $context["options_key"] = (($context["type_prefix"] ?? null) . "transformation_options");
        // line 2
        echo "<input id=\"field_";
        echo twig_escape_filter($this->env, ($context["column_number"] ?? null), "html", null, true);
        echo "_";
        echo twig_escape_filter($this->env, (($context["ci"] ?? null) - ($context["ci_offset"] ?? null)), "html", null, true);
        echo "\"
    type=\"text\"
    name=\"field_";
        // line 4
        echo twig_escape_filter($this->env, ($context["options_key"] ?? null), "html", null, true);
        echo "[";
        echo twig_escape_filter($this->env, ($context["column_number"] ?? null), "html", null, true);
        echo "]\"
    size=\"16\"
    class=\"textfield\"
    value=\"";
        // line 7
        if (($this->getAttribute(($context["column_meta"] ?? null), "Field", [], "array", true, true) && $this->getAttribute($this->getAttribute(($context["mime_map"] ?? null), $this->getAttribute(($context["column_meta"] ?? null), "Field", [], "array"), [], "array", false, true), ($context["options_key"] ?? null), [], "array", true, true))) {
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["mime_map"] ?? null), $this->getAttribute(($context["column_meta"] ?? null), "Field", [], "array"), [], "array"), ($context["options_key"] ?? null), [], "array"), "html", null, true);
        }
        // line 9
        echo "\" />
";
    }

    public function getTemplateName()
    {
        return "columns_definitions/transformation_option.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 9,  50 => 8,  48 => 7,  40 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "columns_definitions/transformation_option.twig", "/usr/share/phpmyadmin/templates/columns_definitions/transformation_option.twig");
    }
}
