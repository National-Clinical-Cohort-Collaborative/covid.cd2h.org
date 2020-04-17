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

/* core/themes/stable/templates/admin/ckeditor-settings-toolbar.html.twig */
class __TwigTemplate_536f8051df83582baa7acaa3558caa66dc1e2b218595e2f7148f89b1630a5fe1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["spaceless" => 14, "trans" => 19, "for" => 28];
        $filters = ["t" => 16, "escape" => 29];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['spaceless', 'trans', 'for'],
                ['t', 'escape'],
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
        // line 14
        ob_start(function () { return ''; });
        // line 15
        echo "  <fieldset role=\"form\" aria-labelledby=\"ckeditor-button-configuration ckeditor-button-description\">
    <legend id=\"ckeditor-button-configuration\">";
        // line 16
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toolbar configuration"));
        echo "</legend>
    <div class=\"fieldset-wrapper\">
      <div id=\"ckeditor-button-description\" class=\"fieldset-description\">";
        // line 19
        echo t("Move a button into the <em>Active toolbar</em> to enable it, or into the list of <em>Available buttons</em> to disable it. Buttons may be moved with the mouse or keyboard arrow keys. Toolbar group names are provided to support screen reader users. Empty toolbar groups will be removed upon save.", array());
        // line 22
        echo "</div>
      <div class=\"ckeditor-toolbar-disabled clearfix\">
        ";
        // line 25
        echo "        <div class=\"ckeditor-toolbar-available\">
          <label for=\"ckeditor-available-buttons\">";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Available buttons"));
        echo "</label>
          <ul id=\"ckeditor-available-buttons\" class=\"ckeditor-buttons clearfix\" role=\"form\" data-drupal-ckeditor-button-sorting=\"source\">
          ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["disabled_buttons"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["disabled_button"]) {
            // line 29
            echo "             <li";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["disabled_button"], "attributes", []), "addClass", [0 => "ckeditor-button"], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["disabled_button"], "value", [])), "html", null, true);
            echo "</li>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['disabled_button'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "          </ul>
        </div>
        ";
        // line 34
        echo "        <div class=\"ckeditor-toolbar-dividers\">
          <label for=\"ckeditor-multiple-buttons\">";
        // line 35
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Button divider"));
        echo "</label>
          <ul id=\"ckeditor-multiple-buttons\" class=\"ckeditor-multiple-buttons\" role=\"form\" data-drupal-ckeditor-button-sorting=\"dividers\">
          ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["multiple_buttons"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["multiple_button"]) {
            // line 38
            echo "            <li";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["multiple_button"], "attributes", []), "addClass", [0 => "ckeditor-multiple-button"], "method")), "html", null, true);
            echo ">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["multiple_button"], "value", [])), "html", null, true);
            echo "</li>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['multiple_button'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "          </ul>
        </div>
      </div>
      ";
        // line 44
        echo "      <div class=\"clearfix\">
        <label id=\"ckeditor-active-toolbar\">";
        // line 45
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Active toolbar"));
        echo "</label>
      </div>
      <div data-toolbar=\"active\" role=\"form\" class=\"ckeditor-toolbar ckeditor-toolbar-active clearfix\">
        <ul class=\"ckeditor-active-toolbar-configuration\" role=\"presentation\" aria-label=\"";
        // line 48
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("CKEditor toolbar and button configuration."));
        echo "\">
        ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["active_buttons"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["button_row"]) {
            // line 50
            echo "          <li class=\"ckeditor-row\" role=\"group\" aria-labelledby=\"ckeditor-active-toolbar\">
            <ul class=\"ckeditor-toolbar-groups clearfix\">
            ";
            // line 52
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["button_row"]);
            foreach ($context['_seq'] as $context["group_name"] => $context["button_group"]) {
                // line 53
                echo "              <li class=\"ckeditor-toolbar-group\" role=\"presentation\" data-drupal-ckeditor-type=\"group\" data-drupal-ckeditor-toolbar-group-name=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["group_name"]), "html", null, true);
                echo "\" tabindex=\"0\">
                <h3 class=\"ckeditor-toolbar-group-name\" id=\"ckeditor-toolbar-group-aria-label-for-";
                // line 54
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["button_group"], "group_name_class", [])), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["group_name"]), "html", null, true);
                echo "</h3>
                <ul class=\"ckeditor-buttons ckeditor-toolbar-group-buttons\" role=\"toolbar\" data-drupal-ckeditor-button-sorting=\"target\" aria-labelledby=\"ckeditor-toolbar-group-aria-label-for-";
                // line 55
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["button_group"], "group_name_class", [])), "html", null, true);
                echo "\">
                ";
                // line 56
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["button_group"], "buttons", []));
                foreach ($context['_seq'] as $context["_key"] => $context["active_button"]) {
                    // line 57
                    echo "                  <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["active_button"], "attributes", []), "addClass", [0 => (($this->getAttribute($context["active_button"], "multiple", [])) ? ("ckeditor-multiple-button") : ("ckeditor-button"))], "method")), "html", null, true);
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["active_button"], "value", [])), "html", null, true);
                    echo "</li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['active_button'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 59
                echo "                </ul>
              </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['group_name'], $context['button_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "            </ul>
          </li>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 65
            echo "          <li>
            <ul class=\"ckeditor-buttons\"></ul>
          </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['button_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "        </ul>
      </div>
    </div>
  </fieldset>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/ckeditor-settings-toolbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 69,  197 => 65,  190 => 62,  182 => 59,  171 => 57,  167 => 56,  163 => 55,  157 => 54,  152 => 53,  148 => 52,  144 => 50,  139 => 49,  135 => 48,  129 => 45,  126 => 44,  121 => 40,  110 => 38,  106 => 37,  101 => 35,  98 => 34,  94 => 31,  83 => 29,  79 => 28,  74 => 26,  71 => 25,  67 => 22,  65 => 19,  60 => 16,  57 => 15,  55 => 14,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/stable/templates/admin/ckeditor-settings-toolbar.html.twig", "/Library/WebServer/COVID/web/core/themes/stable/templates/admin/ckeditor-settings-toolbar.html.twig");
    }
}
