<?php

/* themes/custom/useit/soprema_theme/templates/system/page.html.twig */
class __TwigTemplate_4e071ed2c03b0892df35e3adf243df222c51443485d3b41187232d114b00cb8d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'navbar' => array($this, 'block_navbar'),
            'top_header' => array($this, 'block_top_header'),
            'left_side_nav' => array($this, 'block_left_side_nav'),
            'main' => array($this, 'block_main'),
            'highlighted' => array($this, 'block_highlighted'),
            'header' => array($this, 'block_header'),
            'sidebar_first' => array($this, 'block_sidebar_first'),
            'help' => array($this, 'block_help'),
            'content' => array($this, 'block_content'),
            'sidebar_second' => array($this, 'block_sidebar_second'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("set" => 54, "if" => 56, "block" => 57);
        $filters = array("clean_class" => 62, "t" => 74);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if', 'block'),
                array('clean_class', 't'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 54
        $context["container"] = (($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", array()), "fluid_container", array())) ? ("container-fluid") : ("container"));
        // line 56
        if (($this->getAttribute(($context["page"] ?? null), "navigation", array()) || $this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array()))) {
            // line 57
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 94
        echo "
";
        // line 96
        if (($this->getAttribute(($context["page"] ?? null), "top_header", array()) && ($context["logged_in"] ?? null))) {
            // line 97
            echo "    ";
            $this->displayBlock('top_header', $context, $blocks);
        }
        // line 103
        echo "
";
        // line 105
        if (($this->getAttribute(($context["page"] ?? null), "left_side_nav", array()) && ($context["logged_in"] ?? null))) {
            // line 106
            echo "    ";
            $this->displayBlock('left_side_nav', $context, $blocks);
        }
        // line 122
        echo "
";
        // line 124
        $this->displayBlock('main', $context, $blocks);
        // line 193
        echo "
";
        // line 194
        if ($this->getAttribute(($context["page"] ?? null), "footer", array())) {
            // line 195
            echo "  ";
            $this->displayBlock('footer', $context, $blocks);
        }
    }

    // line 57
    public function block_navbar($context, array $blocks = array())
    {
        // line 58
        echo "    ";
        // line 59
        $context["navbar_classes"] = array(0 => "navbar", 1 => (($this->getAttribute($this->getAttribute(        // line 61
($context["theme"] ?? null), "settings", array()), "navbar_inverse", array())) ? ("navbar-inverse") : ("navbar-default")), 2 => (($this->getAttribute($this->getAttribute(        // line 62
($context["theme"] ?? null), "settings", array()), "navbar_position", array())) ? (("navbar-" . \Drupal\Component\Utility\Html::getClass($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", array()), "navbar_position", array())))) : (($context["container"] ?? null))));
        // line 65
        echo "    <header";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["navbar_attributes"] ?? null), "addClass", array(0 => ($context["navbar_classes"] ?? null)), "method"), "html", null, true));
        echo " id=\"navbar\" role=\"banner\">
      ";
        // line 66
        if ( !$this->getAttribute(($context["navbar_attributes"] ?? null), "hasClass", array(0 => ($context["container"] ?? null)), "method")) {
            // line 67
            echo "        <div class=\"";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true));
            echo "\">
      ";
        }
        // line 69
        echo "      <div class=\"navbar-header\">
        ";
        // line 70
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "navigation", array()), "html", null, true));
        echo "
        ";
        // line 72
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array())) {
            // line 73
            echo "          <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#navbar-collapse\">
            <span class=\"sr-only\">";
            // line 74
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toggle navigation")));
            echo "</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
        ";
        }
        // line 80
        echo "      </div>

      ";
        // line 83
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array())) {
            // line 84
            echo "        <div id=\"navbar-collapse\" class=\"navbar-collapse collapse\">
          ";
            // line 85
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "navigation_collapsible", array()), "html", null, true));
            echo "
        </div>
      ";
        }
        // line 88
        echo "      ";
        if ( !$this->getAttribute(($context["navbar_attributes"] ?? null), "hasClass", array(0 => ($context["container"] ?? null)), "method")) {
            // line 89
            echo "        </div>
      ";
        }
        // line 91
        echo "    </header>
  ";
    }

    // line 97
    public function block_top_header($context, array $blocks = array())
    {
        // line 98
        echo "        <div class=\"top--header ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true));
        echo "\">
            ";
        // line 99
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "top_header", array()), "html", null, true));
        echo "
        </div>
    ";
    }

    // line 106
    public function block_left_side_nav($context, array $blocks = array())
    {
        // line 107
        echo "        <div class=\"left-side--navbar\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#left_navbar_collapse\">
                    <span class=\"sr-only\">";
        // line 110
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toggle navigation")));
        echo "</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
            </div>
            <div id=\"left_navbar_collapse\" class=\"navbar-collapse collapse\">
                ";
        // line 117
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "left_side_nav", array()), "html", null, true));
        echo "
            </div>
        </div>
    ";
    }

    // line 124
    public function block_main($context, array $blocks = array())
    {
        // line 125
        echo "  <div role=\"main\" class=\"main-container ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true));
        echo " js-quickedit-main-content\">
    ";
        // line 127
        echo "    ";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", array())) {
            // line 128
            echo "        ";
            $this->displayBlock('highlighted', $context, $blocks);
            // line 135
            echo "    ";
        }
        // line 136
        echo "
    <div class=\"row\">

      ";
        // line 140
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "header", array())) {
            // line 141
            echo "        ";
            $this->displayBlock('header', $context, $blocks);
            // line 146
            echo "      ";
        }
        // line 147
        echo "
      ";
        // line 149
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", array())) {
            // line 150
            echo "        ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 155
            echo "      ";
        }
        // line 156
        echo "
      ";
        // line 158
        echo "      ";
        // line 159
        $context["content_classes"] = array(0 => ((($this->getAttribute(        // line 160
($context["page"] ?? null), "sidebar_first", array()) && $this->getAttribute(($context["page"] ?? null), "sidebar_second", array()))) ? ("col-sm-6") : ("")), 1 => ((($this->getAttribute(        // line 161
($context["page"] ?? null), "sidebar_first", array()) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_second", array())))) ? ("col-sm-9") : ("")), 2 => ((($this->getAttribute(        // line 162
($context["page"] ?? null), "sidebar_second", array()) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_first", array())))) ? ("col-sm-9") : ("")), 3 => (((twig_test_empty($this->getAttribute(        // line 163
($context["page"] ?? null), "sidebar_first", array())) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_second", array())))) ? ("col-sm-12") : ("")));
        // line 166
        echo "      <section";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["content_attributes"] ?? null), "addClass", array(0 => ($context["content_classes"] ?? null)), "method"), "html", null, true));
        echo ">

        ";
        // line 169
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "help", array())) {
            // line 170
            echo "          ";
            $this->displayBlock('help', $context, $blocks);
            // line 173
            echo "        ";
        }
        // line 174
        echo "
        ";
        // line 176
        echo "        ";
        $this->displayBlock('content', $context, $blocks);
        // line 180
        echo "      </section>

      ";
        // line 183
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", array())) {
            // line 184
            echo "        ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 189
            echo "      ";
        }
        // line 190
        echo "    </div>
  </div>
";
    }

    // line 128
    public function block_highlighted($context, array $blocks = array())
    {
        // line 129
        echo "            <div class=\"row\">
              <div class=\"col-sm-12\">
                  <div class=\"highlighted\">";
        // line 131
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "highlighted", array()), "html", null, true));
        echo "</div>
              </div>
            </div>
        ";
    }

    // line 141
    public function block_header($context, array $blocks = array())
    {
        // line 142
        echo "          <div class=\"col-sm-12\" role=\"heading\">
            ";
        // line 143
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "header", array()), "html", null, true));
        echo "
          </div>
        ";
    }

    // line 150
    public function block_sidebar_first($context, array $blocks = array())
    {
        // line 151
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 152
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "sidebar_first", array()), "html", null, true));
        echo "
          </aside>
        ";
    }

    // line 170
    public function block_help($context, array $blocks = array())
    {
        // line 171
        echo "            ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "help", array()), "html", null, true));
        echo "
          ";
    }

    // line 176
    public function block_content($context, array $blocks = array())
    {
        // line 177
        echo "          <a id=\"main-content\"></a>
          ";
        // line 178
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "content", array()), "html", null, true));
        echo "
        ";
    }

    // line 184
    public function block_sidebar_second($context, array $blocks = array())
    {
        // line 185
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 186
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "sidebar_second", array()), "html", null, true));
        echo "
          </aside>
        ";
    }

    // line 195
    public function block_footer($context, array $blocks = array())
    {
        // line 196
        echo "    <footer class=\"footer ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true));
        echo "\" role=\"contentinfo\">
      ";
        // line 197
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["page"] ?? null), "footer", array()), "html", null, true));
        echo "
    </footer>
  ";
    }

    public function getTemplateName()
    {
        return "themes/custom/useit/soprema_theme/templates/system/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  387 => 197,  382 => 196,  379 => 195,  372 => 186,  369 => 185,  366 => 184,  360 => 178,  357 => 177,  354 => 176,  347 => 171,  344 => 170,  337 => 152,  334 => 151,  331 => 150,  324 => 143,  321 => 142,  318 => 141,  310 => 131,  306 => 129,  303 => 128,  297 => 190,  294 => 189,  291 => 184,  288 => 183,  284 => 180,  281 => 176,  278 => 174,  275 => 173,  272 => 170,  269 => 169,  263 => 166,  261 => 163,  260 => 162,  259 => 161,  258 => 160,  257 => 159,  255 => 158,  252 => 156,  249 => 155,  246 => 150,  243 => 149,  240 => 147,  237 => 146,  234 => 141,  231 => 140,  226 => 136,  223 => 135,  220 => 128,  217 => 127,  212 => 125,  209 => 124,  201 => 117,  191 => 110,  186 => 107,  183 => 106,  176 => 99,  171 => 98,  168 => 97,  163 => 91,  159 => 89,  156 => 88,  150 => 85,  147 => 84,  144 => 83,  140 => 80,  131 => 74,  128 => 73,  125 => 72,  121 => 70,  118 => 69,  112 => 67,  110 => 66,  105 => 65,  103 => 62,  102 => 61,  101 => 59,  99 => 58,  96 => 57,  90 => 195,  88 => 194,  85 => 193,  83 => 124,  80 => 122,  76 => 106,  74 => 105,  71 => 103,  67 => 97,  65 => 96,  62 => 94,  58 => 57,  56 => 56,  54 => 54,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "themes/custom/useit/soprema_theme/templates/system/page.html.twig", "/opt/drupal8/soprema/web/themes/custom/useit/soprema_theme/templates/system/page.html.twig");
    }
}
