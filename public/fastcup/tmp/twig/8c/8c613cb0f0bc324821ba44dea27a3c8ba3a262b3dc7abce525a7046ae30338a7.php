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

/* display/export/options_output_compression.twig */
class __TwigTemplate_b91b5971989759619e7b76612963ccad82edfd3a0f5a113278794a70f94f8e8c extends \Twig\Template
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
        if ((($context["is_zip"] ?? null) || ($context["is_gzip"] ?? null))) {
            // line 2
            echo "    <li>
        <label for=\"compression\" class=\"desc\">
            ";
            // line 4
            echo _gettext("Compression:");
            // line 5
            echo "        </label>
        <select id=\"compression\" name=\"compression\">
            <option value=\"none\">";
            // line 7
            echo _gettext("None");
            echo "</option>
            ";
            // line 8
            if (($context["is_zip"] ?? null)) {
                // line 9
                echo "                <option value=\"zip\"";
                // line 10
                echo (((($context["selected_compression"] ?? null) == "zip")) ? (" selected") : (""));
                echo ">
                    ";
                // line 11
                echo _gettext("zipped");
                // line 12
                echo "                </option>
            ";
            }
            // line 14
            echo "            ";
            if (($context["is_gzip"] ?? null)) {
                // line 15
                echo "                <option value=\"gzip\"";
                // line 16
                echo (((($context["selected_compression"] ?? null) == "gzip")) ? (" selected") : (""));
                echo ">
                    ";
                // line 17
                echo _gettext("gzipped");
                // line 18
                echo "                </option>
            ";
            }
            // line 20
            echo "        </select>
    </li>
";
        } else {
            // line 23
            echo "    <input type=\"hidden\" name=\"compression\" value=\"";
            echo twig_escape_filter($this->env, ($context["selected_compression"] ?? null), "html", null, true);
            echo "\">
";
        }
    }

    public function getTemplateName()
    {
        return "display/export/options_output_compression.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 23,  75 => 20,  71 => 18,  69 => 17,  65 => 16,  63 => 15,  60 => 14,  56 => 12,  54 => 11,  50 => 10,  48 => 9,  46 => 8,  42 => 7,  38 => 5,  36 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/options_output_compression.twig", "/usr/share/phpmyadmin/templates/display/export/options_output_compression.twig");
    }
}
