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

/* themes/mbase/templates/form/fieldset.html.twig */
class __TwigTemplate_57dadb65d719977f8ab5606a1c2193d24e83095606d1a825c0fef2e75f2732c8 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 24, "if" => 37];
        $filters = ["escape" => 32];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 24
        $context["classes"] = [0 => "form-item", 1 => "js-form-wrapper", 2 => "form-wrapper", 3 => "panel", 4 => "panel-default"];
        // line 32
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo " >

  ";
        // line 35
        echo "  <div class = 'panel-heading'>
    <div class = \"panel-title\">";
        // line 36
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["legend"] ?? null), "title", [])), "html", null, true);
        echo "
    ";
        // line 37
        if (($context["required"] ?? null)) {
            echo "<span class = \"form-required\"> *</span> ";
        }
        // line 38
        echo "    </div>
  </div>
  <div class = \"panel-body\" id=\"";
        // line 40
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "id", [])), "html", null, true);
        echo "-child\" >
  <div class=\"details-wrapper\">
    ";
        // line 42
        if (($context["errors"] ?? null)) {
            // line 43
            echo "      <div class=\"form-error-message\">
        <strong>";
            // line 44
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null)), "html", null, true);
            echo "</strong>
      </div>
    ";
        }
        // line 47
        echo "    ";
        if (($context["prefix"] ?? null)) {
            // line 48
            echo "      <span class=\"field-prefix\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null)), "html", null, true);
            echo "</span>
    ";
        }
        // line 50
        echo "    ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null)), "html", null, true);
        echo "
    ";
        // line 51
        if (($context["suffix"] ?? null)) {
            // line 52
            echo "      <span class=\"field-suffix\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null)), "html", null, true);
            echo "</span>
    ";
        }
        // line 54
        echo "  </div>
  </div>
  ";
        // line 56
        if ($this->getAttribute(($context["description"] ?? null), "content", [])) {
            // line 57
            echo "      <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["description"] ?? null), "attributes", []), "addClass", [0 => "description panel-footer"], "method")), "html", null, true);
            echo ">
       <span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span> 
      ";
            // line 59
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "content", [])), "html", null, true);
            echo "
      </div>
  ";
        }
        // line 62
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/form/fieldset.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 62,  128 => 59,  122 => 57,  120 => 56,  116 => 54,  110 => 52,  108 => 51,  103 => 50,  97 => 48,  94 => 47,  88 => 44,  85 => 43,  83 => 42,  78 => 40,  74 => 38,  70 => 37,  66 => 36,  63 => 35,  57 => 32,  55 => 24,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/form/fieldset.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/form/fieldset.html.twig");
    }
}
