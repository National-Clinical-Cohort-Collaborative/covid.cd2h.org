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

/* themes/icemagic/templates/layout/page--front.html.twig */
class __TwigTemplate_fca09defca9abafa7082f074af72a2b5f00e01f437ad6e5572f940cd92641892 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'navbar' => [$this, 'block_navbar'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 74, "block" => 75];
        $filters = ["escape" => 110, "t" => 84];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block'],
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
        // line 66
        echo "<div class=\"navbar-nih-branding-bar l-ribbon-wrapper\">
  <ul class=\"l-ribbon\">
      <li><span class=\"ribbon-hhs\" ></span><a id =\"hhs\" href=\"https://www.hhs.gov\">U.S. Department of Health &amp; Human Services</a><span class=\"ribbon-right\"></span></li>
      <li><span class=\"ribbon-nih\"></span><a id=\"nih\" href=\"https://www.nih.gov/\">National Institutes of Health</a><span class=\"ribbon-right\"></span></li>
      <li><span class=\"ribbon-nih\"></span><a id=\"ncats\" href=\"https://ncats.nih.gov/\">National Center for Advancing Translational Sciences</a><span class=\"ribbon-right\"></span></li>
  </ul>
</div>

";
        // line 74
        if (((($this->getAttribute(($context["page"] ?? null), "branding", []) || $this->getAttribute(($context["page"] ?? null), "navigation", [])) || ($context["secondary_nav"] ?? null)) || ($context["primary_nav"] ?? null))) {
            // line 75
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 107
        echo "
    ";
        // line 108
        if ($this->getAttribute(($context["page"] ?? null), "logo_image", [])) {
            // line 109
            echo "      <section class = \"logo_image_box col-12\">
        ";
            // line 110
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "logo_image", [])), "html", null, true);
            echo "
      </section>
    ";
        }
        // line 113
        echo "
    
    ";
        // line 115
        if (($this->getAttribute(($context["page"] ?? null), "front_block_1", []) && $this->getAttribute(($context["page"] ?? null), "front_block_2", []))) {
            // line 116
            echo "      
      <section class = \"front-blocks front-block-1 container\">
        <div class=\"row\">
          <div class=\"card-surround\">
            ";
            // line 120
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_block_1", [])), "html", null, true);
            echo "
          </div>
          <div class=\"card-surround\">
            ";
            // line 123
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_block_2", [])), "html", null, true);
            echo "
          </div>
        <div>
      </section>
    ";
        }
        // line 128
        echo "    
    ";
        // line 129
        if (($this->getAttribute(($context["page"] ?? null), "front_block_3", []) && $this->getAttribute(($context["page"] ?? null), "front_block_4", []))) {
            // line 130
            echo "      <section class = \"front-blocks front-block-2 container\">
        <div class=\"row\">
          <div class=\"card-surround\">
            ";
            // line 133
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_block_3", [])), "html", null, true);
            echo "
          </div>
          <div class=\"card-surround\">
            ";
            // line 136
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_block_4", [])), "html", null, true);
            echo "
          </div>
        </div>
      </section>
    ";
        }
        // line 141
        echo "
    ";
        // line 142
        if (($this->getAttribute(($context["page"] ?? null), "front_block_5", []) && $this->getAttribute(($context["page"] ?? null), "front_block_6", []))) {
            // line 143
            echo "      <section class = \"front-blocks front-block-3 container\">
        <div class=\"row\">
          <div class=\"card-surround\">
            ";
            // line 146
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_block_5", [])), "html", null, true);
            echo "
          </div>
          <div class=\"card-surround\">
            ";
            // line 149
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_block_6", [])), "html", null, true);
            echo "
          </div>
        </div>
      </section>
    ";
        }
        // line 154
        echo "    

    ";
        // line 156
        if ($this->getAttribute(($context["page"] ?? null), "content_about", [])) {
            // line 157
            echo "      <section class = \"content-about plugin-content\">
         <div class = \"";
            // line 158
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
        ";
            // line 159
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_about", [])), "html", null, true);
            echo "
          </div>
      </section>
    ";
        } elseif ($this->getAttribute(        // line 162
($context["snippet"] ?? null), "content_about", [])) {
            // line 163
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "content_about", [])), "html", null, true);
            echo "
    ";
        }
        // line 165
        echo "

    ";
        // line 167
        if ($this->getAttribute(($context["page"] ?? null), "content_positive", [])) {
            // line 168
            echo "      <section class = \"content-positive plugin-content\">
         <div class = \"";
            // line 169
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
        ";
            // line 170
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_positive", [])), "html", null, true);
            echo "
          </div>
      </section>
    ";
        } elseif ($this->getAttribute(        // line 173
($context["snippet"] ?? null), "content_positive", [])) {
            // line 174
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "content_positive", [])), "html", null, true);
            echo "
    ";
        }
        // line 176
        echo "
    ";
        // line 177
        if ($this->getAttribute(($context["page"] ?? null), "content_boxed", [])) {
            // line 178
            echo "      <section class = \"content-boxed plugin-content\">
         <div class = \"";
            // line 179
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
        ";
            // line 180
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_boxed", [])), "html", null, true);
            echo "
          </div>
      </section>
    ";
        } elseif ($this->getAttribute(        // line 183
($context["snippet"] ?? null), "content_boxed", [])) {
            // line 184
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "content_boxed", [])), "html", null, true);
            echo "
    ";
        }
        // line 186
        echo "
    ";
        // line 187
        if ($this->getAttribute(($context["page"] ?? null), "content_bottom_box", [])) {
            // line 188
            echo "      <section class = \"content-bottom-box plugin-content\">
        <div class = \"";
            // line 189
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
          ";
            // line 190
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_bottom_box", [])), "html", null, true);
            echo "
        </div>
      </section>
    ";
        }
        // line 194
        echo "
<div class=\"main-container ";
        // line 195
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
        echo "\">

  <header role=\"banner\" id=\"page-header\">
    ";
        // line 198
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
        echo "
  </header> <!-- /#page-header -->

  <div class=\"row\">

  ";
        // line 203
        if (($this->getAttribute(($context["page"] ?? null), "sidebar_first", []) && $this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) {
            // line 204
            echo "    <aside class=\"col-sm-12 col-md-3\" role=\"complementary\">
      ";
            // line 205
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
            echo "
    </aside>  <!-- End first aside. -->

    <section class=\"col-sm-12 col-md-6 middle-content\">
      ";
            // line 209
            if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
                // line 210
                echo "        <div class=\"highlighted\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
                echo "</div>
      ";
            }
            // line 212
            echo "      <a id=\"main-content\"></a>
      ";
            // line 213
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
            echo "
      ";
            // line 214
            if (($context["title"] ?? null)) {
                // line 215
                echo "        <h1 class=\"page-header\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
                echo "</h1>
      ";
            }
            // line 217
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
            echo "

      ";
            // line 219
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["messages"] ?? null)), "html", null, true);
            echo "
      ";
            // line 220
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["tabs"] ?? null)), "html", null, true);
            echo "
      ";
            // line 221
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true);
            echo "

      ";
            // line 223
            if (($context["action_links"] ?? null)) {
                // line 224
                echo "        <ul class=\"action-links\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null)), "html", null, true);
                echo "</ul>
      ";
            }
            // line 226
            echo "
      ";
            // line 227
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
    </section>

    <aside class=\"col-sm-12 col-md-3\" role=\"complementary\">
      ";
            // line 231
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
            echo "
    </aside> <!-- End second aside. -->

  ";
        } elseif (($this->getAttribute(        // line 234
($context["page"] ?? null), "sidebar_first", []) || $this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) {
            // line 235
            echo "    ";
            if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
                // line 236
                echo "      <aside class=\"col-md-3 col-sm-6 col-xs-12\" role=\"complementary\">
        ";
                // line 237
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
                echo "
      </aside>  <!-- End first aside. -->
    ";
            }
            // line 240
            echo "
    <section class=\"col-md-9 col-sm-12 middle-content\">
      ";
            // line 242
            if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
                // line 243
                echo "        <div class=\"highlighted\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
                echo "</div>
      ";
            }
            // line 245
            echo "      <a id=\"main-content\"></a>
      ";
            // line 246
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
            echo "
      ";
            // line 247
            if (($context["title"] ?? null)) {
                // line 248
                echo "        <h1 class=\"page-header\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
                echo "</h1>
      ";
            }
            // line 250
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
            echo "

      ";
            // line 252
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["messages"] ?? null)), "html", null, true);
            echo "
      ";
            // line 253
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["tabs"] ?? null)), "html", null, true);
            echo "
      ";
            // line 254
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true);
            echo "

      ";
            // line 256
            if (($context["action_links"] ?? null)) {
                // line 257
                echo "        <ul class=\"action-links\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null)), "html", null, true);
                echo "</ul>
      ";
            }
            // line 259
            echo "
      ";
            // line 260
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
    </section>
  
    ";
            // line 263
            if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
                // line 264
                echo "      <aside class=\"col-md-3 col-sm-6 col-xs-12\" role=\"complementary\">
        ";
                // line 265
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
                echo "
      </aside> <!-- End second aside. -->
    ";
            }
            // line 268
            echo "
  ";
        } elseif ((twig_test_empty($this->getAttribute(        // line 269
($context["page"] ?? null), "sidebar_first", [])) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])))) {
            // line 270
            echo "    <section class=\"col-sm-12\">
      ";
            // line 271
            if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
                // line 272
                echo "        <div class=\"highlighted\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
                echo "</div>
      ";
            }
            // line 274
            echo "      
      <a id=\"main-content\"></a>
      ";
            // line 276
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null)), "html", null, true);
            echo "
      ";
            // line 277
            if (($context["title"] ?? null)) {
                // line 278
                echo "        <h1 class=\"page-header\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
                echo "</h1>
      ";
            }
            // line 280
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null)), "html", null, true);
            echo "
      ";
            // line 281
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["messages"] ?? null)), "html", null, true);
            echo "
      ";
            // line 282
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["tabs"] ?? null)), "html", null, true);
            echo "
      ";
            // line 283
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true);
            echo "
      ";
            // line 284
            if (($context["action_links"] ?? null)) {
                // line 285
                echo "        <ul class=\"action-links\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null)), "html", null, true);
                echo "</ul>
      ";
            }
            // line 287
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
    </section>
  ";
        }
        // line 290
        echo "
  </div>
</div>


  ";
        // line 295
        if ($this->getAttribute(($context["page"] ?? null), "bottom_content", [])) {
            // line 296
            echo "    <section class = \"content-bottom plugin-content\">
      ";
            // line 297
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_content", [])), "html", null, true);
            echo "
    </section>
  ";
        }
        // line 300
        echo "  
<footer id = \"footer-wrap\" class = \"footer-section section footer-wrap\">

  ";
        // line 303
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 304
            echo "  <div class = \"footer-message text-center\">
    <div class = \"";
            // line 305
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">  
    ";
            // line 306
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
    </div>    
  </div>
  ";
        } elseif ($this->getAttribute(        // line 309
($context["snippet"] ?? null), "footer", [])) {
            // line 310
            echo "  <div class = \"footer-message text-center\">
    <div class = \"";
            // line 311
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">  
    ";
            // line 312
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer", [])), "html", null, true);
            echo "
    </div>    
  </div>
  ";
        }
        // line 316
        echo "  
\t";
        // line 317
        if (($this->getAttribute(($context["page"] ?? null), "footer_menu", []) || $this->getAttribute(($context["snippet"] ?? null), "footer_menu", []))) {
            // line 318
            echo "  <div class = \"footer-menus force-menu-hr xs-force-menu-vr xs-text-center\">
  \t<div class = \"";
            // line 319
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
  \t\t<div class = \"row\">
        ";
            // line 321
            if ($this->getAttribute(($context["page"] ?? null), "footer_menu", [])) {
                // line 322
                echo "        <div class = \"footer-menus-block xs-text-center col-xs-12\">
          ";
                // line 323
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_menu", [])), "html", null, true);
                echo "
        </div>
        ";
            } elseif ($this->getAttribute(            // line 325
($context["snippet"] ?? null), "footer_menu", [])) {
                // line 326
                echo "        <div class = \"footer-menus-snippet xs-text-center col-xs-12\">
          ";
                // line 327
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer_menu", [])), "html", null, true);
                echo "
        </div>
        ";
            }
            // line 330
            echo "  \t\t</div>
  \t</div>
  </div>
  ";
        }
        // line 333
        echo "  
  
  <div class = \"footer-copyright-social text-center\">
    <div class = \"";
        // line 336
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
        echo "\">
      <div class = \"row\">

      ";
        // line 339
        if ($this->getAttribute(($context["page"] ?? null), "footer_copyright", [])) {
            // line 340
            echo "        <div class = \"col-sm-12 col-xs-12 footer-copyright text-left xs-text-center\">
        ";
            // line 341
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_copyright", [])), "html", null, true);
            echo "
        </div>
        ";
        } elseif ($this->getAttribute(        // line 343
($context["snippet"] ?? null), "footer_copyright", [])) {
            // line 344
            echo "        <div class = \"col-sm-12 col-xs-12 footer-copyright text-left xs-text-center\">
        ";
            // line 345
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer_copyright", [])), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 348
        echo "        
        ";
        // line 349
        if ($this->getAttribute(($context["page"] ?? null), "footer_social", [])) {
            // line 350
            echo "        <div class = \"col-sm-12 col-xs-12 footer-social text-right xs-text-center\">
            ";
            // line 351
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_social", [])), "html", null, true);
            echo "
        </div>
        ";
        } elseif ($this->getAttribute(        // line 353
($context["snippet"] ?? null), "footer_social", [])) {
            // line 354
            echo "        <div class = \"col-sm-12 col-xs-12 footer-social text-right xs-text-center\">
            ";
            // line 355
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["snippet"] ?? null), "footer_social", [])), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 358
        echo "
      </diV>
    </div>
  </div>
</footer>
";
    }

    // line 75
    public function block_navbar($context, array $blocks = [])
    {
        // line 76
        echo "    <header";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null)), "html", null, true);
        echo " id=\"navbar\" role=\"banner\" data-spy=\"affix\"  data-offset-top=\"70\">
    ";
        // line 77
        if ( !($context["navbar_is_default"] ?? null)) {
            // line 78
            echo "      <div class = \"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true);
            echo "\">
    ";
        }
        // line 80
        echo "      <div class=\"navbar-header\">
        ";
        // line 81
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "branding", [])), "html", null, true);
        echo "
        ";
        // line 83
        echo "        <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
          <span class=\"sr-only\">";
        // line 84
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toggle navigation"));
        echo "</span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
          <span class=\"icon-bar\"></span>
        </button>
      </div>

      ";
        // line 92
        echo "      ";
        if ((($this->getAttribute(($context["page"] ?? null), "navigation", []) || ($context["secondary_nav"] ?? null)) || ($context["primary_nav"] ?? null))) {
            // line 93
            echo "        <div class=\"navbar-collapse collapse\">
          <nav role=\"navigation\">
          ";
            // line 95
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "navigation", [])), "html", null, true);
            echo "
          ";
            // line 96
            if (($context["secondary_nav"] ?? null)) {
                echo " ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["secondary_nav"] ?? null)), "html", null, true);
                echo " ";
            }
            // line 97
            echo "          ";
            if (($context["primary_nav"] ?? null)) {
                echo " ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["primary_nav"] ?? null)), "html", null, true);
                echo " ";
            }
            // line 98
            echo "          </nav>
        </div>
      ";
        }
        // line 101
        echo "      ";
        if ( !($context["navbar_is_default"] ?? null)) {
            // line 102
            echo "        </div>
      ";
        }
        // line 104
        echo "    </header>
  ";
    }

    public function getTemplateName()
    {
        return "themes/icemagic/templates/layout/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  737 => 104,  733 => 102,  730 => 101,  725 => 98,  718 => 97,  712 => 96,  708 => 95,  704 => 93,  701 => 92,  691 => 84,  688 => 83,  684 => 81,  681 => 80,  675 => 78,  673 => 77,  668 => 76,  665 => 75,  656 => 358,  650 => 355,  647 => 354,  645 => 353,  640 => 351,  637 => 350,  635 => 349,  632 => 348,  626 => 345,  623 => 344,  621 => 343,  616 => 341,  613 => 340,  611 => 339,  605 => 336,  600 => 333,  594 => 330,  588 => 327,  585 => 326,  583 => 325,  578 => 323,  575 => 322,  573 => 321,  568 => 319,  565 => 318,  563 => 317,  560 => 316,  553 => 312,  549 => 311,  546 => 310,  544 => 309,  538 => 306,  534 => 305,  531 => 304,  529 => 303,  524 => 300,  518 => 297,  515 => 296,  513 => 295,  506 => 290,  499 => 287,  493 => 285,  491 => 284,  487 => 283,  483 => 282,  479 => 281,  474 => 280,  468 => 278,  466 => 277,  462 => 276,  458 => 274,  452 => 272,  450 => 271,  447 => 270,  445 => 269,  442 => 268,  436 => 265,  433 => 264,  431 => 263,  425 => 260,  422 => 259,  416 => 257,  414 => 256,  409 => 254,  405 => 253,  401 => 252,  395 => 250,  389 => 248,  387 => 247,  383 => 246,  380 => 245,  374 => 243,  372 => 242,  368 => 240,  362 => 237,  359 => 236,  356 => 235,  354 => 234,  348 => 231,  341 => 227,  338 => 226,  332 => 224,  330 => 223,  325 => 221,  321 => 220,  317 => 219,  311 => 217,  305 => 215,  303 => 214,  299 => 213,  296 => 212,  290 => 210,  288 => 209,  281 => 205,  278 => 204,  276 => 203,  268 => 198,  262 => 195,  259 => 194,  252 => 190,  248 => 189,  245 => 188,  243 => 187,  240 => 186,  234 => 184,  232 => 183,  226 => 180,  222 => 179,  219 => 178,  217 => 177,  214 => 176,  208 => 174,  206 => 173,  200 => 170,  196 => 169,  193 => 168,  191 => 167,  187 => 165,  181 => 163,  179 => 162,  173 => 159,  169 => 158,  166 => 157,  164 => 156,  160 => 154,  152 => 149,  146 => 146,  141 => 143,  139 => 142,  136 => 141,  128 => 136,  122 => 133,  117 => 130,  115 => 129,  112 => 128,  104 => 123,  98 => 120,  92 => 116,  90 => 115,  86 => 113,  80 => 110,  77 => 109,  75 => 108,  72 => 107,  68 => 75,  66 => 74,  56 => 66,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/icemagic/templates/layout/page--front.html.twig", "/Library/WebServer/COVID/web/themes/icemagic/templates/layout/page--front.html.twig");
    }
}
