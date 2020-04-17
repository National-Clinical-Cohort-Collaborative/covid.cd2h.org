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

/* themes/mbase/templates/content/node.html.twig */
class __TwigTemplate_fd2d338f36ddeada516ebbf0c7ce11444314b93e786e3459362d3a2fd7c3c0e4 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 69, "if" => 85, "trans" => 103];
        $filters = ["clean_class" => 74, "escape" => 81, "without" => 92];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans'],
                ['clean_class', 'escape', 'without'],
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
        // line 69
        $context["classes"] = [0 => "node", 1 => "clearfix", 2 => "panel", 3 => "panel-default", 4 => ("node--type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 74
($context["node"] ?? null), "bundle", [])))), 5 => (($this->getAttribute(        // line 75
($context["node"] ?? null), "isPromoted", [], "method")) ? ("node--promoted") : ("")), 6 => (($this->getAttribute(        // line 76
($context["node"] ?? null), "isSticky", [], "method")) ? ("node--sticky") : ("")), 7 => (( !$this->getAttribute(        // line 77
($context["node"] ?? null), "isPublished", [], "method")) ? ("node--unpublished") : ("")), 8 => ((        // line 78
($context["view_mode"] ?? null)) ? (("node--view-mode-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null))))) : (""))];
        // line 81
        echo "<article";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">

  <div class = \"panel-body\">
    ";
        // line 84
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
        echo "
    ";
        // line 85
        if ( !($context["page"] ?? null)) {
            // line 86
            echo "    <h2";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_attributes"] ?? null)), "html", null, true);
            echo ">
    <a href=\"";
            // line 87
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null)), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
            echo "</a>
    </h2>
    ";
        }
        // line 90
        echo "    ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
        echo "
    <div";
        // line 91
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => "node__content"], "method")), "html", null, true);
        echo ">
      ";
        // line 92
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "links", "comment", "comment_forum"), "html", null, true);
        echo "
    </div>
  </div>

  ";
        // line 96
        if ((($context["display_submitted"] ?? null) || $this->getAttribute(($context["content"] ?? null), "links", []))) {
            // line 97
            echo "  <footer class=\"node__meta panel-footer\">
    <div class=\"submitted row\">

    <div";
            // line 100
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["author_attributes"] ?? null), "addClass", [0 => "node__submitted col-xs-12 col-sm-9 col-md-10"], "method")), "html", null, true);
            echo ">
      ";
            // line 101
            if (($context["display_submitted"] ?? null)) {
                // line 102
                echo "      <div class = \"clearfix\">
        ";
                // line 103
                echo t("Submitted by <strong>@author_name</strong> on <strong>@date</strong>", array("@author_name" => ($context["author_name"] ?? null), "@date" => ($context["date"] ?? null), ));
                // line 104
                echo "      </div>
      ";
            }
            // line 106
            echo "      ";
            if ($this->getAttribute(($context["content"] ?? null), "links", [])) {
                // line 107
                echo "        <div class = \"clearfix margin-sm-top\">
          ";
                // line 108
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "links", [])), "html", null, true);
                echo "
        </div>
      ";
            }
            // line 111
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["metadata"] ?? null)), "html", null, true);
            echo "
    </div>

    ";
            // line 114
            if (($context["author_picture"] ?? null)) {
                // line 115
                echo "      <div class = \"col-xs-12 col-sm-3 col-md-2 text-right meta-data-user-picture\">
        ";
                // line 116
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author_picture"] ?? null)), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 119
            echo "    </div>
  </footer>
  ";
        }
        // line 122
        echo "
</article>
";
        // line 124
        if ($this->getAttribute(($context["content"] ?? null), "comment", [])) {
            // line 125
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "comment", [])), "html", null, true);
            echo "
";
        }
        // line 127
        echo "
";
        // line 128
        if ($this->getAttribute(($context["content"] ?? null), "comment_forum", [])) {
            // line 129
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "comment_forum", [])), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/content/node.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  178 => 129,  176 => 128,  173 => 127,  167 => 125,  165 => 124,  161 => 122,  156 => 119,  150 => 116,  147 => 115,  145 => 114,  138 => 111,  132 => 108,  129 => 107,  126 => 106,  122 => 104,  120 => 103,  117 => 102,  115 => 101,  111 => 100,  106 => 97,  104 => 96,  97 => 92,  93 => 91,  88 => 90,  80 => 87,  75 => 86,  73 => 85,  69 => 84,  62 => 81,  60 => 78,  59 => 77,  58 => 76,  57 => 75,  56 => 74,  55 => 69,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/content/node.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/content/node.html.twig");
    }
}
