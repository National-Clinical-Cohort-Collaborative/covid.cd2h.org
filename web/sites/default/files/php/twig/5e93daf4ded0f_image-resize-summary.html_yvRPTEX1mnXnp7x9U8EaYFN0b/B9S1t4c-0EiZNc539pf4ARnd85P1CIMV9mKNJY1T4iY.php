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

/* core/themes/stable/templates/admin/image-resize-summary.html.twig */
class __TwigTemplate_fd560e51c24725ef69d65bbd854264c4c27da83c842c7932450a0f097a913487 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 16, "trans" => 20];
        $filters = ["escape" => 17];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
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
        // line 16
        if (($this->getAttribute(($context["data"] ?? null), "width", []) && $this->getAttribute(($context["data"] ?? null), "height", []))) {
            // line 17
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "width", [])), "html", null, true);
            echo "×";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "height", [])), "html", null, true);
        } else {
            // line 19
            if ($this->getAttribute(($context["data"] ?? null), "width", [])) {
                // line 20
                echo "    ";
                echo t("width @data.width", array("@data.width" => $this->getAttribute(                // line 21
($context["data"] ?? null), "width", []), ));
                // line 23
                echo "  ";
            } elseif ($this->getAttribute(($context["data"] ?? null), "height", [])) {
                // line 24
                echo "    ";
                echo t("height @data.height", array("@data.height" => $this->getAttribute(                // line 25
($context["data"] ?? null), "height", []), ));
                // line 27
                echo "  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/image-resize-summary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 27,  73 => 25,  71 => 24,  68 => 23,  66 => 21,  64 => 20,  62 => 19,  57 => 17,  55 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/stable/templates/admin/image-resize-summary.html.twig", "/Library/WebServer/COVID/web/core/themes/stable/templates/admin/image-resize-summary.html.twig");
    }
}
