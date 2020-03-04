<?= $helper->getHeadPrintCode('Edit ' . $entity_class_name) ?>

{% block heading_h1 %}
{{ 'Edit'|trans }}  <?= $entity_class_name ?>
{% endblock %}

{% block heading_btn %}

<div class="btn-group" role="group">
    <a href="{{ path('<?= $route_name ?>_index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i>
        {{ 'back to list'|trans }}
    </a>
</div>

{% endblock %}
{% block content %}
<div class="card shadow mb-4">
    <div class="card-body">
        {{ include('<?= $route_name ?>/_form.html.twig', {'button_label': 'Update'}) }}
        <hr/>
        {{ include('<?= $route_name ?>/_delete_form.html.twig') }}
    </div>
</div>
{% endblock %}
