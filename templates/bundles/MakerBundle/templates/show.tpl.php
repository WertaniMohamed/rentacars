<?= $helper->getHeadPrintCode($entity_class_name) ?>

{% block heading_h1 %}
<?= $entity_class_name ?>
{% endblock %}

{% block heading_btn %}

<div class="btn-group" role="group">

    <a href="{{ path('<?= $route_name ?>_index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> {{ 'back to list'|trans }} </a>

    <a href="{{ path('<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"
       class="btn btn-sm btn-info shadow-sm">
        <i class="fas fa-edit fa-sm text-white-50"></i> {{ 'edit'|trans }}
    </a>

</div>

{% endblock %}


{% block content %}
<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table">
            <tbody>
            <?php foreach ($entity_fields as $field): ?>
                <tr>
                    <th><?= ucfirst($field['fieldName']) ?></th>
                    <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr/>
        {{ include('<?= $route_name ?>/_delete_form.html.twig') }}
    </div>
</div>
{% endblock %}

