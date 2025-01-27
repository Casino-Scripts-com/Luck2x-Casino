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

/* display/export/options_output_separate_files.twig */
class __TwigTemplate_b745ddc35e73f08878a1dd8f7964716c5f0a4693c96fa053ff3aaf7e359cd5e3 extends \Twig\Template
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
        echo "<li>
    <input type=\"checkbox\" id=\"checkbox_as_separate_files\"
        name=\"as_separate_files\" value=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["export_type"] ?? null), "html", null, true);
        echo "\"";
        // line 4
        echo ((($context["is_checked"] ?? null)) ? (" checked") : (""));
        echo ">
    <label for=\"checkbox_as_separate_files\">
        ";
        // line 6
        if ((($context["export_type"] ?? null) == "server")) {
            // line 7
            echo "            ";
            echo _gettext("Export databases as separate files");
            // line 8
            echo "        ";
        } elseif ((($context["export_type"] ?? null) == "database")) {
            // line 9
            echo "            ";
            echo _gettext("Export tables as separate files");
            // line 10
            echo "        ";
        }
        // line 11
        echo "    </label>
</li>
";
    }

    public function getTemplateName()
    {
        return "display/export/options_output_separate_files.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 11,  53 => 10,  50 => 9,  47 => 8,  44 => 7,  42 => 6,  37 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/options_output_separate_files.twig", "/usr/share/phpmyadmin/templates/display/export/options_output_separate_files.twig");
    }
}
