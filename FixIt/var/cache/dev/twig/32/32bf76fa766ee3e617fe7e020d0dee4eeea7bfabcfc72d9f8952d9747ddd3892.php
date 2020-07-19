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

/* demandeur/show.html.twig */
class __TwigTemplate_9899a2f99133f7ea6b6ad2813020888de6d8585f7ddd8436e6c6e3ea1c38ae11 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "demandeur/show.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "demandeur/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "demandeur/show.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <h1>Demandeur</h1>

    <table>
        <tbody>
            <tr>
                <th>Id</th>
                <td>";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "id", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "adresse", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Ville</th>
                <td>";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "ville", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Codepostal</th>
                <td>";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "codePostal", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Datenaissance</th>
                <td>";
        // line 26
        if ($this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "datenaissance", [])) {
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "datenaissance", []), "Y-m-d"), "html", null, true);
        }
        echo "</td>
            </tr>
            <tr>
                <th>Sexe</th>
                <td>";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "sexe", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Nom</th>
                <td>";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "nom", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Prenom</th>
                <td>";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "prenom", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Tel</th>
                <td>";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "tel", []), "html", null, true);
        echo "</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute(($context["demandeur"] ?? $this->getContext($context, "demandeur")), "image", []), "html", null, true);
        echo "</td>
            </tr>
        </tbody>
    </table>

    <ul>
        <li>
            <a href=\"";
        // line 53
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("demandeur_index");
        echo "\">Back to the list</a>
        </li>
    </ul>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "demandeur/show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 53,  133 => 46,  126 => 42,  119 => 38,  112 => 34,  105 => 30,  96 => 26,  89 => 22,  82 => 18,  75 => 14,  68 => 10,  60 => 4,  51 => 3,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
    <h1>Demandeur</h1>

    <table>
        <tbody>
            <tr>
                <th>Id</th>
                <td>{{ demandeur.id }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ demandeur.adresse }}</td>
            </tr>
            <tr>
                <th>Ville</th>
                <td>{{ demandeur.ville }}</td>
            </tr>
            <tr>
                <th>Codepostal</th>
                <td>{{ demandeur.codePostal }}</td>
            </tr>
            <tr>
                <th>Datenaissance</th>
                <td>{% if demandeur.datenaissance %}{{ demandeur.datenaissance|date('Y-m-d') }}{% endif %}</td>
            </tr>
            <tr>
                <th>Sexe</th>
                <td>{{ demandeur.sexe }}</td>
            </tr>
            <tr>
                <th>Nom</th>
                <td>{{ demandeur.nom }}</td>
            </tr>
            <tr>
                <th>Prenom</th>
                <td>{{ demandeur.prenom }}</td>
            </tr>
            <tr>
                <th>Tel</th>
                <td>{{ demandeur.tel }}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>{{ demandeur.image }}</td>
            </tr>
        </tbody>
    </table>

    <ul>
        <li>
            <a href=\"{{ path('demandeur_index') }}\">Back to the list</a>
        </li>
    </ul>
{% endblock %}
", "demandeur/show.html.twig", "C:\\xampp\\htdocs\\NewVersion\\FixIt\\app\\Resources\\views\\demandeur\\show.html.twig");
    }
}
