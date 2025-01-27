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

/* display/export/options_output_charset.twig */
class __TwigTemplate_41689ad154f3f8185ff282f582b2f91e0cf30a80e9138d94a1da34aa8b8ed929 extends \Twig\Template
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
    <label for=\"select_charset\" class=\"desc\">
        ";
        // line 3
        echo _gettext("Character set of the file:");
        // line 4
        echo "    </label>
    <select id=\"select_charset\" name=\"charset\" size=\"1\">
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["encodings"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["charset"]) {
            // line 7
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["charset"], "html", null, true);
            echo "\"";
            // line 8
            if (((twig_test_empty(($context["export_charset"] ?? null)) && ($context["charset"] == "utf-8")) || (            // line 9
$context["charset"] == ($context["export_charset"] ?? null)))) {
                // line 10
                echo "                    selected";
            }
            // line 11
            echo ">";
            // line 12
            echo twig_escape_filter($this->env, $context["charset"], "html", null, true);
            // line 13
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['charset'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "    </select>
</li>
";
    }

    public function getTemplateName()
    {
        return "display/export/options_output_charset.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 15,  58 => 13,  56 => 12,  54 => 11,  51 => 10,  49 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 4,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/options_output_charset.twig", "/usr/share/phpmyadmin/templates/display/export/options_output_charset.twig");
    }
}
