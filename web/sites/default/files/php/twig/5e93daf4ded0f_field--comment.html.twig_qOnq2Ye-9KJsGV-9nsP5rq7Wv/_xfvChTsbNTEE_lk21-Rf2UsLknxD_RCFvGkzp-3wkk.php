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

/* themes/mbase/templates/field/field--comment.html.twig */
class __TwigTemplate_b648f364f2463f289852129a2c725709d9ae35f73ed65306fc25d54ea18d5946 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 30, "if" => 49];
        $filters = ["clean_class" => 30, "escape" => 48];
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
        // line 30
        $context["field_name_class"] = \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["field_name"] ?? null)));
        // line 32
        $context["classes"] = [0 => "field", 1 => ((("field-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 34
($context["entity_type"] ?? null)))) . "--") . $this->sandbox->ensureToStringAllowed(($context["field_name_class"] ?? null))), 2 => ("field-name-" . $this->sandbox->ensureToStringAllowed(        // line 35
($context["field_name_class"] ?? null))), 3 => ("field-type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 36
($context["field_type"] ?? null)))), 4 => ("field-label-" . $this->sandbox->ensureToStringAllowed(        // line 37
($context["label_display"] ?? null))), 5 => (((        // line 38
($context["label_display"] ?? null) == "inline")) ? ("clearfix") : ("")), 6 => "comment-wrapper"];
        // line 43
        $context["title_classes"] = [0 => "title", 1 => (((        // line 45
($context["label_display"] ?? null) == "visually_hidden")) ? ("visually-hidden hidden") : (""))];
        // line 48
        echo "<section";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 49
        if (((($context["comments"] ?? null) &&  !($context["label_hidden"] ?? null)) &&  !($context["no_comments"] ?? null))) {
            // line 50
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
            echo "
    <h3";
            // line 51
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["title_attributes"] ?? null), "addClass", [0 => ($context["title_classes"] ?? null)], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "</h3>
    ";
            // line 52
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
            echo "
  ";
        }
        // line 54
        echo " 
  ";
        // line 55
        if (($context["comment_form"] ?? null)) {
            // line 56
            echo "  <p>
    <a class=\"btn btn-primary add-comment\" data-toggle=\"collapse\" href=\"#multiCollapseExample1\" role=\"button\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample1\">Add New Comment</a>
  </p>
  <div class=\"row\">
    <div class=\"col\">
      <div class=\"collapse multi-collapse\" id=\"multiCollapseExample1\">
        <div class=\"card card-body\">
          <div class = \"well well-sm\">
            ";
            // line 64
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["comment_form"] ?? null)), "html", null, true);
            echo "
          </div>
        </div>
      </div>
    </div>
  </div>
  ";
        }
        // line 71
        echo "   
  ";
        // line 72
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["comments"] ?? null)), "html", null, true);
        echo "
 
</section>
";
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/field/field--comment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 72,  115 => 71,  105 => 64,  95 => 56,  93 => 55,  90 => 54,  85 => 52,  79 => 51,  74 => 50,  72 => 49,  67 => 48,  65 => 45,  64 => 43,  62 => 38,  61 => 37,  60 => 36,  59 => 35,  58 => 34,  57 => 32,  55 => 30,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/field/field--comment.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/field/field--comment.html.twig");
    }
}
