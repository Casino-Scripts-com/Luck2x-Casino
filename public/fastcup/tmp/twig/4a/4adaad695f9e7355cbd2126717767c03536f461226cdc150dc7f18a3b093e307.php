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

/* display/export/options_format.twig */
class __TwigTemplate_cf06904c45603255de95cfb94a1e1d27cb3acdcf7b724562f47b8f5dbc379303 extends \Twig\Template
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
        echo "<div class=\"exportoptions\" id=\"format_specific_opts\">
    <h3>";
        // line 2
        echo _gettext("Format-specific options:");
        echo "</h3>
    <p class=\"no_js_msg\" id=\"scroll_to_options_msg\">
        ";
        // line 4
        echo _gettext("Scroll down to fill in the options for the selected format and ignore the options for other formats.");
        // line 5
        echo "    </p>
    ";
        // line 6
        echo ($context["options"] ?? null);
        echo "
</div>

";
        // line 9
        if (($context["can_convert_kanji"] ?? null)) {
            // line 10
            echo "    ";
            // line 11
            echo "    <div class=\"exportoptions\" id=\"kanji_encoding\">
        <h3>";
            // line 12
            echo _gettext("Encoding Conversion:");
            echo "</h3>
        ";
            // line 13
            $this->loadTemplate("encoding/kanji_encoding_form.twig", "display/export/options_format.twig", 13)->display($context);
            // line 14
            echo "    </div>
";
        }
        // line 16
        echo "
<div class=\"exportoptions\" id=\"submit\">
    <input type=\"submit\" value=\"";
        // line 18
        echo _gettext("Go");
        echo "\" id=\"buttonGo\"";
        // line 21
        if ((($context["exec_time_limit"] ?? null) > 0)) {
            // line 22
            echo "            onclick=\"check_time_out(";
            echo twig_escape_filter($this->env, ($context["exec_time_limit"] ?? null), "html", null, true);
            echo ")\"";
        }
        // line 23
        echo ">
</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/options_format.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 23,  75 => 22,  73 => 21,  70 => 18,  66 => 16,  62 => 14,  60 => 13,  56 => 12,  53 => 11,  51 => 10,  49 => 9,  43 => 6,  40 => 5,  38 => 4,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/options_format.twig", "/usr/share/phpmyadmin/templates/display/export/options_format.twig");
    }
}
