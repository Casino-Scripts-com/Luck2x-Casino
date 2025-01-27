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

/* display/export/template_loading.twig */
class __TwigTemplate_a9f371446ca7da689982573bed5c0e5da5c52a7534687fe4426f2154f25cb1eb extends \Twig\Template
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
        echo "<div class=\"exportoptions\" id=\"export_templates\">
    <h3>";
        // line 2
        echo _gettext("Export templates:");
        echo "</h3>

    <div class=\"floatleft\">
        <form method=\"post\" action=\"tbl_export.php\" id=\"newTemplateForm\" class=\"ajax\">
            <h4>";
        // line 6
        echo _gettext("New template:");
        echo "</h4>
            <input type=\"text\" name=\"templateName\" id=\"templateName\"
                maxlength=\"64\" placeholder=\"";
        // line 8
        echo _gettext("Template name");
        echo "\" required>
            <input type=\"submit\" name=\"createTemplate\" id=\"createTemplate\"
                value=\"";
        // line 10
        echo _gettext("Create");
        echo "\">
        </form>
    </div>

    <div class=\"floatleft\" style=\"margin-left: 50px;\">
        <form method=\"post\" action=\"tbl_export.php\" id=\"existingTemplatesForm\" class=\"ajax\">
            <h4>";
        // line 16
        echo _gettext("Existing templates:");
        echo "</h4>
            <label for=\"template\">";
        // line 17
        echo _gettext("Template:");
        echo "</label>
            <select name=\"template\" id=\"template\" required>
                ";
        // line 19
        echo ($context["options"] ?? null);
        echo "
            </select>
            <input type=\"submit\" name=\"updateTemplate\" id=\"updateTemplate\" value=\"";
        // line 21
        echo _gettext("Update");
        echo "\">
            <input type=\"submit\" name=\"deleteTemplate\" id=\"deleteTemplate\" value=\"";
        // line 22
        echo _gettext("Delete");
        echo "\">
        </form>
    </div>

    <div class=\"clearfloat\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/template_loading.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 22,  73 => 21,  68 => 19,  63 => 17,  59 => 16,  50 => 10,  45 => 8,  40 => 6,  33 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/template_loading.twig", "/usr/share/phpmyadmin/templates/display/export/template_loading.twig");
    }
}
