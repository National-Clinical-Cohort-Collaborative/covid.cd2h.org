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

/* themes/mbase/templates/dataset/item-list--search-results.html.twig */
class __TwigTemplate_44908a2116e430bfa6bf5db35e0eebe66dd34471d7c11aa3613ce0de28f25c6e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 24, "for" => 32];
        $filters = [];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
                [],
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

    protected function doGetParent(array $context)
    {
        // line 1
        return "item-list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 24
        $context["classes"] = [0 => "search-results", 1 => "list-group", 2 => ($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 27
($context["context"] ?? null), "plugin", [])) . "-results")];
        // line 30
        $context["list_type"] = "ul";
        // line 31
        $context["attributes"] = $this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method");
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 33
            $context["item"] = $this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => "list-group-item"], "method");
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1
        $this->parent = $this->loadTemplate("item-list.html.twig", "themes/mbase/templates/dataset/item-list--search-results.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/dataset/item-list--search-results.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 1,  70 => 33,  66 => 32,  64 => 31,  62 => 30,  60 => 27,  59 => 24,  53 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/dataset/item-list--search-results.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/dataset/item-list--search-results.html.twig");
    }
}
