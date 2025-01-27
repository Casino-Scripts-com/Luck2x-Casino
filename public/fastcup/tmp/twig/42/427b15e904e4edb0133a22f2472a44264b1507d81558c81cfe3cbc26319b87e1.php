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

/* display/export/template_options.twig */
class __TwigTemplate_2873eb65f1a34d106beb341bee990d82ee92f06352ae40846829191d105a0e6a extends \Twig\Template
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
        echo "<option value=\"\">-- ";
        echo _gettext("Select a template");
        echo " --</option>

";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["templates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["template"]) {
            // line 4
            echo "    <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["template"], "id", []), "html", null, true);
            echo "\"";
            echo ((($this->getAttribute($context["template"], "id", []) == ($context["selected_template"] ?? null))) ? (" selected") : (""));
            echo ">
        ";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute($context["template"], "name", []), "html", null, true);
            echo "
    </option>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['template'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "display/export/template_options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 5,  40 => 4,  36 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/template_options.twig", "/usr/share/phpmyadmin/templates/display/export/template_options.twig");
    }
}
