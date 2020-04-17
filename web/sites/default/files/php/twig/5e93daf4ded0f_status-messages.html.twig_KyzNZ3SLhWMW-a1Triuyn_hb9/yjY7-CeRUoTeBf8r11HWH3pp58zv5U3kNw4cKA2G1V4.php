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

/* themes/mbase/templates/misc/status-messages.html.twig */
class __TwigTemplate_ade28e0d36c4e46d23fc78d16835ffd591b1576f912d050bce13de16ba418b03 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 26, "if" => 27, "set" => 28];
        $filters = ["escape" => 41, "length" => 53, "first" => 60];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'set'],
                ['escape', 'length', 'first'],
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
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["message_list"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 27
            echo "  ";
            if (($context["type"] == "status")) {
                // line 28
                echo "    ";
                $context["type"] = "info";
                // line 29
                echo "  ";
            } elseif (($context["type"] == "error")) {
                // line 30
                echo "    ";
                $context["type"] = "danger";
                // line 31
                echo "  ";
            }
            // line 32
            echo "
    ";
            // line 34
            $context["classes"] = [0 => "alert", 1 => ("alert-" . $this->sandbox->ensureToStringAllowed(            // line 36
$context["type"])), 2 =>             // line 37
($context["alert_dismissible"] ?? null)];
            // line 40
            echo "
  <div class=\"";
            // line 41
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method"), "class", [])), "html", null, true);
            echo "\" role=\"alert\" aria-label=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["status_headings"] ?? null), $context["type"], [], "array")), "html", null, true);
            echo "\">
     
    ";
            // line 43
            if ((($context["alert_dismissible"] ?? null) == "alert-dismissible")) {
                // line 44
                echo "      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
    ";
            }
            // line 46
            echo "     
    ";
            // line 47
            if (($context["type"] == "error")) {
                // line 48
                echo "      <div role=\"alert\">
    ";
            }
            // line 50
            echo "      ";
            if ($this->getAttribute(($context["status_headings"] ?? null), $context["type"], [], "array")) {
                // line 51
                echo "        <h2 class=\"visually-hidden\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["status_headings"] ?? null), $context["type"], [], "array")), "html", null, true);
                echo "</h2>
      ";
            }
            // line 53
            echo "      ";
            if ((twig_length_filter($this->env, $context["messages"]) > 1)) {
                // line 54
                echo "        <ul class=\"messages__list\">
          ";
                // line 55
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 56
                    echo "            <li class=\"messages__item\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["message"]), "html", null, true);
                    echo "</li>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 58
                echo "        </ul>
      ";
            } else {
                // line 60
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_first($this->env, $this->sandbox->ensureToStringAllowed($context["messages"])), "html", null, true);
                echo "
      ";
            }
            // line 62
            echo "    ";
            if (($context["type"] == "error")) {
                // line 63
                echo "      </div>
    ";
            }
            // line 65
            echo "  </div>
  ";
            // line 67
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "removeClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "themes/mbase/templates/misc/status-messages.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 67,  151 => 65,  147 => 63,  144 => 62,  138 => 60,  134 => 58,  125 => 56,  121 => 55,  118 => 54,  115 => 53,  109 => 51,  106 => 50,  102 => 48,  100 => 47,  97 => 46,  93 => 44,  91 => 43,  84 => 41,  81 => 40,  79 => 37,  78 => 36,  77 => 34,  74 => 32,  71 => 31,  68 => 30,  65 => 29,  62 => 28,  59 => 27,  55 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mbase/templates/misc/status-messages.html.twig", "/Library/WebServer/COVID/web/themes/mbase/templates/misc/status-messages.html.twig");
    }
}
