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

/* themes/mbase/templates/form/form-element.html.twig */
class __TwigTemplate_e08624ea6229118ce88544d55adf16a7e4cd3f830af50a2d2a711b95c2b1bdf6 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 49, "if" => 83];
        $filters = ["clean_class" => 51, "escape" => 82];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape'],
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
        // line 49
        $context["classes"] = [0 => "form-item", 1 => ("form-item-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 51
($context["name"] ?? null)))), 2 => ("form-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 52
($context["type"] ?? null)))), 3 => ((!twig_in_filter(        // line 53
($context["title_display"] ?? null), [0 => "after", 1 => "before"])) ? ("form-no-label") : ("")), 4 => (((        // line 54
($context["disabled"] ?? null) == "disabled")) ? ("form-disabled") : ("")), 5 => ((        // line 55
($context["is_form_group"] ?? null)) ? ("form-group") : ("")), 6 => ((        // line 56
($context["is_radio"] ?? null)) ? ("radio") : ("")), 7 => ((        // line 57
($context["is_checkbox"] ?? null)) ? ("checkbox") : ("")), 8 => ((        // line 58
($context["is_autocomplete"] ?? null)) ? ("form-autocomplete") : ("")), 9 => ((        // line 59
($context["has_error"] ?? null)) ? ("error has-error") : (""))];
        // line 63
        echo "
";
        // line 65
        $context["inner_classes"] = [0 => "input-group"];
        // line 69
        echo "
";
        // line 71
        $context["description_classes"] = [0 => "description", 1 => "help-block", 2 => (((        // line 74
($context["description_display"] ?? null) == "invisible")) ? ("visually-hidden") : ("")), 3 => "des-after"];
        // line 79
        $context["input_group_class"] = ((($context["input_group"] ?? null)) ? ("input-group-addon") : (""));
        // line 81
        echo "
<div";
        // line 82
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 83
        if (twig_in_filter(($context["label_display"] ?? null), [0 => "before", 1 => "invisible"])) {
            // line 84
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 86
        echo "

  ";
        // line 88
        if ((((($context["description_display"] ?? null) == "before") && $this->getAttribute(($context["description"] ?? null), "content", [])) && twig_test_empty(($context["has_tooltip"] ?? null)))) {
            // line 89
            echo "    <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "attributes", [])), "html", null, true);
            echo ">
       ";
            // line 90
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "content", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 92
        echo "  
  
  ";
        // line 94
        if (( !twig_test_empty(($context["prefix"] ?? null)) ||  !twig_test_empty(($context["suffix"] ?? null)))) {
            // line 95
            echo "    <div class=\"input-group\">
  ";
        }
        // line 97
        echo "  
  ";
        // line 98
        if ( !twig_test_empty(($context["prefix"] ?? null))) {
            // line 99
            echo "    <span class=\"input-group-addon input-prefix\"> ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["prefix"] ?? null)), "html", null, true);
            echo " </span>
  ";
        }
        // line 101
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null)), "html", null, true);
        echo "
  ";
        // line 102
        if ( !twig_test_empty(($context["suffix"] ?? null))) {
            // line 103
            echo "    <span class=\"input-group-addon input-suffix\"> ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["suffix"] ?? null)), "html", null, true);
            echo " </span>
  ";
        }
        // line 105
        echo "  
  ";
        // line 106
        if (( !twig_test_empty(($context["prefix"] ?? null)) ||  !twig_test_empty(($context["suffix"] ?? null)))) {
            // line 107
            echo "    </div>
  ";
        }
        // line 109
        echo "
  ";
        // line 110
        if ((($context["label_display"] ?? null) == "after")) {
            // line 111
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 113
        echo "  ";
        if (((twig_in_filter(($context["description_display"] ?? null), [0 => "after", 1 => "invisible"]) && $this->getAttribute(($context["description"] ?? null), "content", [])) && twig_test_empty(($context["has_tooltip"] ?? null)))) {
            // line 114
            echo "    <p";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["description"] ?? null), "attributes", []), "addClass", [0 => ($context["description_classes"] ?? null)], "method")), "html", null, true);
            echo ">
    <span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"> </span> ";
            // line 115
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "content", [])), "html", null, true);
            echo "</p>
  ";
        }
        // line 117
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/form/form-element.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 117,  173 => 115,  168 => 114,  165 => 113,  159 => 111,  157 => 110,  154 => 109,  150 => 107,  148 => 106,  145 => 105,  139 => 103,  137 => 102,  132 => 101,  126 => 99,  124 => 98,  121 => 97,  117 => 95,  115 => 94,  111 => 92,  105 => 90,  100 => 89,  98 => 88,  94 => 86,  88 => 84,  86 => 83,  82 => 82,  79 => 81,  77 => 79,  75 => 74,  74 => 71,  71 => 69,  69 => 65,  66 => 63,  64 => 59,  63 => 58,  62 => 57,  61 => 56,  60 => 55,  59 => 54,  58 => 53,  57 => 52,  56 => 51,  55 => 49,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/form/form-element.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/form/form-element.html.twig");
    }
}
