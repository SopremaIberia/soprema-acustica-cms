<?php

/* modules/contrib/slick/templates/slick-slide.html.twig */
class __TwigTemplate_322be33e1c4d38aa7001c9464d77badb6876994e9bd98175d4ae11deb68c1980 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'slick_slide' => array($this, 'block_slick_slide'),
            'slick_caption' => array($this, 'block_slick_caption'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("set" => 21, "block" => 35, "if" => 44);
        $filters = array("clean_class" => 24);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'block', 'if'),
                array('clean_class'),
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

        // line 21
        $context["classes"] = array(0 => "slick__slide", 1 => "slide", 2 => ("slide--" .         // line 22
($context["delta"] ?? null)), 3 => ((twig_test_empty($this->getAttribute(        // line 23
($context["item"] ?? null), "slide", array()))) ? ("slide--text") : ("")), 4 => (($this->getAttribute(        // line 24
($context["settings"] ?? null), "layout", array())) ? (("slide--caption--" . \Drupal\Component\Utility\Html::getClass($this->getAttribute(($context["settings"] ?? null), "layout", array())))) : ("")), 5 => (($this->getAttribute(        // line 25
($context["settings"] ?? null), "class", array())) ? ($this->getAttribute(($context["settings"] ?? null), "class", array())) : ("")));
        // line 29
        $context["content_classes"] = array(0 => (($this->getAttribute(        // line 30
($context["settings"] ?? null), "detroy", array())) ? ("slide") : ("")), 1 => (( !$this->getAttribute(        // line 31
($context["settings"] ?? null), "detroy", array())) ? ("slide__content") : ("")));
        // line 34
        ob_start();
        // line 35
        echo "  ";
        $this->displayBlock('slick_slide', $context, $blocks);
        $context["slide"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 43
        echo "
";
        // line 44
        if ($this->getAttribute(($context["settings"] ?? null), "wrapper", array())) {
            // line 45
            echo "  <div";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["attributes"] ?? null), "addClass", array(0 => ($context["classes"] ?? null)), "method"), "html", null, true));
            echo ">
  ";
            // line 46
            if (twig_test_empty($this->getAttribute(($context["settings"] ?? null), "grid", array()))) {
                echo "<div";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["content_attributes"] ?? null), "addClass", array(0 => ($context["content_classes"] ?? null)), "method"), "html", null, true));
                echo ">";
            }
        }
        // line 48
        echo "
  ";
        // line 49
        if ($this->getAttribute(($context["item"] ?? null), "slide", array())) {
            // line 50
            echo "    ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["slide"] ?? null), "html", null, true));
            echo "
  ";
        }
        // line 52
        echo "
  ";
        // line 53
        if ($this->getAttribute(($context["item"] ?? null), "caption", array())) {
            // line 54
            echo "    ";
            $this->displayBlock('slick_caption', $context, $blocks);
            // line 82
            echo "  ";
        }
        // line 83
        echo "
";
        // line 84
        if ($this->getAttribute(($context["settings"] ?? null), "wrapper", array())) {
            // line 85
            echo "  ";
            if (twig_test_empty($this->getAttribute(($context["settings"] ?? null), "grid", array()))) {
                echo "</div>";
            }
            // line 86
            echo "  </div>
";
        }
    }

    // line 35
    public function block_slick_slide($context, array $blocks = array())
    {
        // line 36
        echo "    ";
        if (($this->getAttribute(($context["settings"] ?? null), "split", array()) &&  !$this->getAttribute(($context["settings"] ?? null), "unslick", array()))) {
            // line 37
            echo "      <div class=\"slide__media\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["item"] ?? null), "slide", array()), "html", null, true));
            echo "</div>
    ";
        } else {
            // line 39
            echo "      ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["item"] ?? null), "slide", array()), "html", null, true));
            echo "
    ";
        }
        // line 41
        echo "  ";
    }

    // line 54
    public function block_slick_caption($context, array $blocks = array())
    {
        // line 55
        echo "      ";
        if ($this->getAttribute(($context["settings"] ?? null), "fullwidth", array())) {
            echo "<div class=\"slide__constrained\">";
        }
        // line 56
        echo "
        <div class=\"slide__caption\">
          ";
        // line 58
        if ($this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "overlay", array())) {
            // line 59
            echo "            <div class=\"slide__overlay\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "overlay", array()), "html", null, true));
            echo "</div>
            ";
            // line 60
            if ($this->getAttribute(($context["settings"] ?? null), "data", array())) {
                echo "<div class=\"slide__data\">";
            }
            // line 61
            echo "          ";
        }
        // line 62
        echo "
          ";
        // line 63
        if ($this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "title", array())) {
            // line 64
            echo "            <h2 class=\"slide__title\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "title", array()), "html", null, true));
            echo "</h2>
          ";
        }
        // line 66
        echo "
          ";
        // line 67
        if ($this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "alt", array())) {
            // line 68
            echo "            <p class=\"slide__description\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "alt", array()), "html", null, true));
            echo "</p>
          ";
        }
        // line 70
        echo "
          ";
        // line 71
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "data", array()), "html", null, true));
        echo "

          ";
        // line 73
        if ($this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "link", array())) {
            // line 74
            echo "            <div class=\"slide__link\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "link", array()), "html", null, true));
            echo "</div>
          ";
        }
        // line 76
        echo "
          ";
        // line 77
        if (($this->getAttribute($this->getAttribute(($context["item"] ?? null), "caption", array()), "overlay", array()) && $this->getAttribute(($context["settings"] ?? null), "data", array()))) {
            echo "</div>";
        }
        // line 78
        echo "        </div>

      ";
        // line 80
        if ($this->getAttribute(($context["settings"] ?? null), "fullwidth", array())) {
            echo "</div>";
        }
        // line 81
        echo "    ";
    }

    public function getTemplateName()
    {
        return "modules/contrib/slick/templates/slick-slide.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 81,  213 => 80,  209 => 78,  205 => 77,  202 => 76,  196 => 74,  194 => 73,  189 => 71,  186 => 70,  180 => 68,  178 => 67,  175 => 66,  169 => 64,  167 => 63,  164 => 62,  161 => 61,  157 => 60,  152 => 59,  150 => 58,  146 => 56,  141 => 55,  138 => 54,  134 => 41,  128 => 39,  122 => 37,  119 => 36,  116 => 35,  110 => 86,  105 => 85,  103 => 84,  100 => 83,  97 => 82,  94 => 54,  92 => 53,  89 => 52,  83 => 50,  81 => 49,  78 => 48,  71 => 46,  66 => 45,  64 => 44,  61 => 43,  57 => 35,  55 => 34,  53 => 31,  52 => 30,  51 => 29,  49 => 25,  48 => 24,  47 => 23,  46 => 22,  45 => 21,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "modules/contrib/slick/templates/slick-slide.html.twig", "/opt/drupal8/soprema/web/modules/contrib/slick/templates/slick-slide.html.twig");
    }
}
