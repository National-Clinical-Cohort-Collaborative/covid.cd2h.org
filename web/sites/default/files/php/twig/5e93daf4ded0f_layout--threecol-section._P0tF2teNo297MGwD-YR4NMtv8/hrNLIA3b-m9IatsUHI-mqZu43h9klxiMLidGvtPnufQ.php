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

/* core/modules/layout_builder/layouts/threecol_section/layout--threecol-section.html.twig */
class __TwigTemplate_4bb8976ba710b0b968a03ba36d0d475746454b203a33aa9baa898852a3a6e8ec extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 13];
        $filters = ["escape" => 14];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
        // line 13
        if (($context["content"] ?? null)) {
            // line 14
            echo "  <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
            echo ">

    ";
            // line 16
            if ($this->getAttribute(($context["content"] ?? null), "first", [])) {
                // line 17
                echo "      <div ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["region_attributes"] ?? null), "first", []), "addClass", [0 => "layout__region", 1 => "layout__region--first"], "method")), "html", null, true);
                echo ">
        ";
                // line 18
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "first", [])), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 21
            echo "
    ";
            // line 22
            if ($this->getAttribute(($context["content"] ?? null), "second", [])) {
                // line 23
                echo "      <div ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["region_attributes"] ?? null), "second", []), "addClass", [0 => "layout__region", 1 => "layout__region--second"], "method")), "html", null, true);
                echo ">
        ";
                // line 24
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "second", [])), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 27
            echo "
    ";
            // line 28
            if ($this->getAttribute(($context["content"] ?? null), "third", [])) {
                // line 29
                echo "      <div ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["region_attributes"] ?? null), "third", []), "addClass", [0 => "layout__region", 1 => "layout__region--third"], "method")), "html", null, true);
                echo ">
        ";
                // line 30
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "third", [])), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 33
            echo "
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/layout_builder/layouts/threecol_section/layout--threecol-section.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 33,  102 => 30,  97 => 29,  95 => 28,  92 => 27,  86 => 24,  81 => 23,  79 => 22,  76 => 21,  70 => 18,  65 => 17,  63 => 16,  57 => 14,  55 => 13,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/modules/layout_builder/layouts/threecol_section/layout--threecol-section.html.twig", "/Library/WebServer/COVID/web/core/modules/layout_builder/layouts/threecol_section/layout--threecol-section.html.twig");
    }
}
