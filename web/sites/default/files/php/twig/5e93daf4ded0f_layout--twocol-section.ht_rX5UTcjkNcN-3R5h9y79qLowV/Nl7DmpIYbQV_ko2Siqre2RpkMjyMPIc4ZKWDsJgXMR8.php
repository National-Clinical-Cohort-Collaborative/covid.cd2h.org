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

/* core/modules/layout_builder/layouts/twocol_section/layout--twocol-section.html.twig */
class __TwigTemplate_f04901561fbb276b5dc5d3929e425edbd31a06ea340559fc4dc32fef23f89c43 extends \Twig\Template
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
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
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
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "core/modules/layout_builder/layouts/twocol_section/layout--twocol-section.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 27,  86 => 24,  81 => 23,  79 => 22,  76 => 21,  70 => 18,  65 => 17,  63 => 16,  57 => 14,  55 => 13,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/modules/layout_builder/layouts/twocol_section/layout--twocol-section.html.twig", "/Library/WebServer/COVID/web/core/modules/layout_builder/layouts/twocol_section/layout--twocol-section.html.twig");
    }
}
