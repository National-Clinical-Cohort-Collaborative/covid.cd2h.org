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

/* themes/mbase/templates/content-edit/image-widget.html.twig */
class __TwigTemplate_43bd5f0c6c50b0026b28988285c39c6f008dfc5f8b3c5b0cb6102db9462029de extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 20];
        $filters = ["escape" => 13, "without" => 27];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'without'],
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
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">
  <div class=\"input-group mbase-file-upload\">
  ";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "upload", [])), "html", null, true);
        echo "
    <span class=\"input-group-btn\">";
        // line 16
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "upload_button", [])), "html", null, true);
        echo "</span>
  </div>

    <div class = \"clearfix image-widget-wrapper\">
    ";
        // line 20
        if ($this->getAttribute(($context["data"] ?? null), "preview", [])) {
            // line 21
            echo "      <div class=\"image-preview visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-block\">
        ";
            // line 22
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "preview", [])), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 25
        echo "      <div class=\"image-data visible-lg-inline-block visible-md-inline-block visible-sm-inline-block visible-xs-block\">
        ";
        // line 27
        echo "        ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["data"] ?? null)), "preview", "alt", "title", "upload", "upload_button"), "html", null, true);
        echo "
      </div>  
    </div>
  
  ";
        // line 31
        if (($this->getAttribute(($context["data"] ?? null), "alt", []) || $this->getAttribute(($context["data"] ?? null), "title", []))) {
            // line 32
            echo "    <div class=\"image-widget-texts clear-fix\">
      ";
            // line 33
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "alt", [])), "html", null, true);
            echo "
      ";
            // line 34
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "title", [])), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 37
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/content-edit/image-widget.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 37,  103 => 34,  99 => 33,  96 => 32,  94 => 31,  86 => 27,  83 => 25,  77 => 22,  74 => 21,  72 => 20,  65 => 16,  61 => 15,  55 => 13,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/content-edit/image-widget.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/content-edit/image-widget.html.twig");
    }
}
