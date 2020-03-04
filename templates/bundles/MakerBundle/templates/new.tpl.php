<?= $helper->getHeadPrintCode('New ' . $entity_class_name) ?>

{% block heading_h1 %}
Create new <?= $entity_class_name ?>
{% endblock %}

{% block heading_btn %}
<div class="btn-group" role="group">
    <a class="btn btn-sm btn-primary shadow-sm" href="{{ path('<?= $route_name ?>_index') }}"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> {{ 'back to list'|trans }} </a>

</div>
{% endblock %}

{% block content %}
<div class="card">
    <div class="card-body">
        {{ include('<?= $route_name ?>/_form.html.twig') }}
    </div>
</div>
{% endblock %}