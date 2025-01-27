<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* file_select_options.twig */
class __TwigTemplate_d9b94fa03450eaa7731201c2e48090366ea0d3f440495b0d0382c014663e47aa extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["filesList"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 2
            echo "  <option value=\"";
            echo twig_escape_filter($this->env, $context["file"], "html", null, true);
            echo "\"";
            if ((0 === twig_compare($context["file"], ($context["active"] ?? null)))) {
                echo " selected=\"selected\"";
            }
            echo ">
    ";
            // line 3
            echo twig_escape_filter($this->env, $context["file"], "html", null, true);
            echo "
  </option>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "file_select_options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "file_select_options.twig", "/usr/share/phpmyadmin/templates/file_select_options.twig");
    }
}
