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

/* themes/icemagic/templates/layout/page.html.twig */
class __TwigTemplate_6534eefd50037b395cc8fbaaa7c62917ec568fa8828480fb2e073ab716cb97b9 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'navbar' => [$this, 'block_navbar'],
            'main' => [$this, 'block_main'],
            'header' => [$this, 'block_header'],
            'highlighted' => [$this, 'block_highlighted'],
            'sidebar_first' => [$this, 'block_sidebar_first'],
            'help' => [$this, 'block_help'],
            'content' => [$this, 'block_content'],
            'sidebar_second' => [$this, 'block_sidebar_second'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 75, "block" => 76, "set" => 147];
        $filters = ["escape" => 185, "t" => 85];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block', 'set'],
                ['escape', 't'],
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
        // line 64
        echo "
";
        // line 66
        echo "<div class=\"navbar-nih-branding-bar l-ribbon-wrapper\">
  <ul class=\"l-ribbon\">
      <li><span class=\"ribbon-hhs\" ></span><a id =\"hhs\" href=\"https://www.hhs.gov\">U.S. Department of Health &amp; Human Services</a><span class=\"ribbon-right\"></span></li>
      <li><span class=\"ribbon-nih\"></span><a id=\"nih\" href=\"https://www.nih.gov/\">National Institutes of Health</a><span class=\"ribbon-right\"></span></li>
      <li><span class=\"ribbon-nih\"></span><a id=\"ncats\" href=\"https://ncats.nih.gov/\">National Center for Advancing Translational Sciences</a><span class=\"ribbon-right\"></span></li>
  </ul>
</div>

";
        // line 75
        if (((($this->getAttribute(($context["page"] ?? null), "branding", []) || $this->getAttribute(($context["page"] ?? null), "navigation", [])) || ($context["secondary_nav"] ?? null)) || ($context["primary_nav"] ?? null))) {
            // line 76
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 108
        echo "
";
        // line 110
        $this->displayBlock('main', $context, $blocks);
        // line 180
        echo "
<footer id = \"footer-wrap\" class = \"footer-section section footer-wrap\">

  ";
        // line 183
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 184
            echo "  <div class = \"footer-message text-center\">
    <div class = \"";
            // line 185
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">  
    ";
            // line 186
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
    </div>    
  </div>
  ";
        } elseif ($this->getAttribute(        // line 189
($context["snippet"] ?? null), "footer", [])) {
            // line 190
            echo "  <div class = \"footer-message text-center\">
    <div class = \"";
            // line 191
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">  
    ";
            // line 192
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer", [])), "html", null, true);
            echo "
    </div>    
  </div>
  ";
        }
        // line 196
        echo "  
\t";
        // line 197
        if (($this->getAttribute(($context["page"] ?? null), "footer_menu", []) || $this->getAttribute(($context["snippet"] ?? null), "footer_menu", []))) {
            // line 198
            echo "  <div class = \"footer-menus force-menu-hr xs-force-menu-vr xs-text-center\">
  \t<div class = \"";
            // line 199
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
  \t\t<div class = \"row\">
        ";
            // line 201
            if ($this->getAttribute(($context["page"] ?? null), "footer_menu", [])) {
                // line 202
                echo "        <div class = \"footer-menus-block xs-text-center col-xs-12\">
          ";
                // line 203
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_menu", [])), "html", null, true);
                echo "
        </div>
        ";
            } elseif ($this->getAttribute(            // line 205
($context["snippet"] ?? null), "footer_menu", [])) {
                // line 206
                echo "        <div class = \"footer-menus-snippet xs-text-center col-xs-12\">
          ";
                // line 207
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer_menu", [])), "html", null, true);
                echo "
        </div>
        ";
            }
            // line 210
            echo "  \t\t</div>
  \t</div>
  </div>
  ";
        }
        // line 213
        echo "  
  
  <div class = \"footer-copyright-social text-center\">
    <div class = \"";
        // line 216
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
        echo "\">
      <div class = \"row\">

      ";
        // line 219
        if ($this->getAttribute(($context["page"] ?? null), "footer_copyright", [])) {
            // line 220
            echo "        <div class = \"col-sm-12 col-xs-12 footer-copyright text-left xs-text-center\">
        ";
            // line 221
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_copyright", [])), "html", null, true);
            echo "
        </div>
        ";
        } elseif ($this->getAttribute(        // line 223
($context["snippet"] ?? null), "footer_copyright", [])) {
            // line 224
            echo "        <div class = \"col-sm-12 col-xs-12 footer-copyright text-left xs-text-center\">
        ";
            // line 225
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer_copyright", [])), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 228
        echo "        
        ";
        // line 229
        if ($this->getAttribute(($context["page"] ?? null), "footer_social", [])) {
            // line 230
            echo "        <div class = \"col-sm-12 col-xs-12 footer-social text-right xs-text-center\">
            ";
            // line 231
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_social", [])), "html", null, true);
            echo "
        </div>
        ";
        } elseif ($this->getAttribute(        // line 233
($context["snippet"] ?? null), "footer_social", [])) {
            // line 234
            echo "        <div class = \"col-sm-12 col-xs-12 footer-social text-right xs-text-center\">
            ";
            // line 235
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer_social", [])), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 238
        echo "
      </diV>
    </div>
  </div>
</footer>
";
    }

    // line 76
    public function block_navbar($context, array $blocks = [])
    {
        // line 77
        echo "    <header";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null)), "html", null, true);
        echo " id=\"navbar\" role=\"banner\" data-spy=\"affix\"  data-offset-top=\"70\">
    ";
        // line 78
        if ( !($context["navbar_is_default"] ?? null)) {
            // line 79
            echo "      <div class = \"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
    ";
        }
        // line 81
        echo "      <div class=\"navbar-header\">
        ";
        // line 82
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "branding", [])), "html", null, true);
        echo "
        ";
        // line 84
        echo "        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
          <span class=\"sr-only\">";
        // line 85
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toggle navigation"));
        echo "</span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
        </button>
      </div>

      ";
        // line 93
        echo "      ";
        if ((($this->getAttribute(($context["page"] ?? null), "navigation", []) || ($context["secondary_nav"] ?? null)) || ($context["primary_nav"] ?? null))) {
            // line 94
            echo "        <div class=\"navbar-collapse collapse\">
          <nav role=\"navigation\">
          ";
            // line 96
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "navigation", [])), "html", null, true);
            echo "
          ";
            // line 97
            if (($context["secondary_nav"] ?? null)) {
                echo " ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["secondary_nav"] ?? null)), "html", null, true);
                echo " ";
            }
            // line 98
            echo "          ";
            if (($context["primary_nav"] ?? null)) {
                echo " ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["primary_nav"] ?? null)), "html", null, true);
                echo " ";
            }
            // line 99
            echo "          </nav>
        </div>
      ";
        }
        // line 102
        echo "      ";
        if ( !($context["navbar_is_default"] ?? null)) {
            // line 103
            echo "        </div>
      ";
        }
        // line 105
        echo "    </header>
  ";
    }

    // line 110
    public function block_main($context, array $blocks = [])
    {
        // line 111
        echo "  <div role=\"main\" class=\"main-container ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
        echo " js-quickedit-main-content\">
    <div class=\"row\">

      ";
        // line 115
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 116
            echo "        ";
            $this->displayBlock('header', $context, $blocks);
            // line 121
            echo "      ";
        }
        // line 122
        echo "      
      ";
        // line 124
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 125
            echo "        ";
            $this->displayBlock('highlighted', $context, $blocks);
            // line 134
            echo "      ";
        }
        // line 135
        echo "
      ";
        // line 137
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 138
            echo "        ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 143
            echo "      ";
        }
        // line 144
        echo "
      ";
        // line 146
        echo "      ";
        // line 147
        $context["content_classes"] = [0 => ((($this->getAttribute(        // line 148
($context["page"] ?? null), "sidebar_first", []) && $this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) ? ("col-sm-6") : ("")), 1 => ((($this->getAttribute(        // line 149
($context["page"] ?? null), "sidebar_first", []) || $this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) ? ("col-sm-9") : ("")), 2 => (((twig_test_empty($this->getAttribute(        // line 150
($context["page"] ?? null), "sidebar_first", [])) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])))) ? ("col-sm-12") : (""))];
        // line 153
        echo "      <section";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => ($context["content_classes"] ?? null)], "method")), "html", null, true);
        echo ">

        ";
        // line 156
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "help", [])) {
            // line 157
            echo "          ";
            $this->displayBlock('help', $context, $blocks);
            // line 160
            echo "        ";
        }
        // line 161
        echo "
        ";
        // line 163
        echo "        ";
        $this->displayBlock('content', $context, $blocks);
        // line 167
        echo "      </section>

      ";
        // line 170
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
            // line 171
            echo "        ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 176
            echo "      ";
        }
        // line 177
        echo "    </div>
  </div>
";
    }

    // line 116
    public function block_header($context, array $blocks = [])
    {
        // line 117
        echo "          <div class=\"col-sm-12\" role=\"heading\">
            ";
        // line 118
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
        echo "
          </div>
        ";
    }

    // line 125
    public function block_highlighted($context, array $blocks = [])
    {
        // line 126
        echo "          <div class=\"highlighted col-sm-12\">
            <div class=\"panel panel-default\">
              <div class = \"panel-body\">
                ";
        // line 129
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
        echo "
              </div>
            </div>
          </div>  
        ";
    }

    // line 138
    public function block_sidebar_first($context, array $blocks = [])
    {
        // line 139
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 140
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
        echo "
          </aside>
        ";
    }

    // line 157
    public function block_help($context, array $blocks = [])
    {
        // line 158
        echo "            ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true);
        echo "
          ";
    }

    // line 163
    public function block_content($context, array $blocks = [])
    {
        // line 164
        echo "          <a id=\"main-content\"></a>
          ";
        // line 165
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
        ";
    }

    // line 171
    public function block_sidebar_second($context, array $blocks = [])
    {
        // line 172
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 173
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
        echo "
          </aside>
        ";
    }

    public function getTemplateName()
    {
        return "themes/icemagic/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  469 => 173,  466 => 172,  463 => 171,  457 => 165,  454 => 164,  451 => 163,  444 => 158,  441 => 157,  434 => 140,  431 => 139,  428 => 138,  419 => 129,  414 => 126,  411 => 125,  404 => 118,  401 => 117,  398 => 116,  392 => 177,  389 => 176,  386 => 171,  383 => 170,  379 => 167,  376 => 163,  373 => 161,  370 => 160,  367 => 157,  364 => 156,  358 => 153,  356 => 150,  355 => 149,  354 => 148,  353 => 147,  351 => 146,  348 => 144,  345 => 143,  342 => 138,  339 => 137,  336 => 135,  333 => 134,  330 => 125,  327 => 124,  324 => 122,  321 => 121,  318 => 116,  315 => 115,  308 => 111,  305 => 110,  300 => 105,  296 => 103,  293 => 102,  288 => 99,  281 => 98,  275 => 97,  271 => 96,  267 => 94,  264 => 93,  254 => 85,  251 => 84,  247 => 82,  244 => 81,  238 => 79,  236 => 78,  231 => 77,  228 => 76,  219 => 238,  213 => 235,  210 => 234,  208 => 233,  203 => 231,  200 => 230,  198 => 229,  195 => 228,  189 => 225,  186 => 224,  184 => 223,  179 => 221,  176 => 220,  174 => 219,  168 => 216,  163 => 213,  157 => 210,  151 => 207,  148 => 206,  146 => 205,  141 => 203,  138 => 202,  136 => 201,  131 => 199,  128 => 198,  126 => 197,  123 => 196,  116 => 192,  112 => 191,  109 => 190,  107 => 189,  101 => 186,  97 => 185,  94 => 184,  92 => 183,  87 => 180,  85 => 110,  82 => 108,  78 => 76,  76 => 75,  66 => 66,  63 => 64,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/icemagic/templates/layout/page.html.twig", "/Library/WebServer/COVID/web/themes/icemagic/templates/layout/page.html.twig");
    }
}
