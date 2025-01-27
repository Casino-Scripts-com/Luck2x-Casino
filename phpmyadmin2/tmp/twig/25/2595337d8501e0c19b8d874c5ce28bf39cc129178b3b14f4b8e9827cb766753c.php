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

/* database/structure/empty_form.twig */
class __TwigTemplate_0a7c48dd3926073a19cc7269e6c682bcbf5e79e65535188d6291ff1fff006178 extends Template
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
        echo "<form action=\"";
        echo PhpMyAdmin\Url::getFromRoute("/database/structure/empty-table");
        echo "\" class=\"disableAjax\" method=\"post\">
  ";
        // line 2
        echo PhpMyAdmin\Url::getHiddenInputs(($context["url_params"] ?? null));
        echo "

  <fieldset class=\"pma-fieldset confirmation\">
    <legend>
      ";
echo _gettext("Do you really want to execute the following query?");
        // line 7
        echo "    </legend>

    <code>";
        // line 9
        echo ($context["full_query"] ?? null);
        echo "</code>
  </fieldset>

  <fieldset class=\"pma-fieldset tblFooters\">
    <div id=\"foreignkeychk\" class=\"float-start\">
      <input type=\"hidden\" name=\"fk_checks\" value=\"0\">
      <input type=\"checkbox\" name=\"fk_checks\" id=\"fk_checks\" value=\"1\"";
        // line 15
        echo ((($context["is_foreign_key_check"] ?? null)) ? (" checked") : (""));
        echo ">
      <label for=\"fk_checks\">";
echo _gettext("Enable foreign key checks");
        // line 16
        echo "</label>
    </div>
    <div class=\"float-end\">
      <input id=\"buttonYes\" class=\"btn btn-secondary\" type=\"submit\" name=\"mult_btn\" value=\"";
echo _gettext("Yes");
        // line 19
        echo "\">
      <input id=\"buttonNo\" class=\"btn btn-secondary\" type=\"submit\" name=\"mult_btn\" value=\"";
echo _gettext("No");
        // line 20
        echo "\">
    </div>
  </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "database/structure/empty_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 20,  74 => 19,  68 => 16,  63 => 15,  54 => 9,  50 => 7,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/structure/empty_form.twig", "/usr/share/phpmyadmin/templates/database/structure/empty_form.twig");
    }
}
