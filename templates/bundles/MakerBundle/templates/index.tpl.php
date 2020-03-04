<?= $helper->getHeadPrintCode($entity_class_name . ' index'); ?>


{% block heading_h1 %}
liste des <?= $entity_class_name ?>
{% endblock %}

{% block heading_btn %}
<a href="{{ path('<?= $route_name ?>_new') }}"
   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Créer un nouveau
</a>
{% endblock %}

{% block content %}

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <?php foreach ($entity_fields as $field): ?>
                        <th><?= ucfirst($field['fieldName']) ?></th>
                    <?php endforeach; ?>
                    <th>actions</th>
                </tr>
                </thead>
                <tbody>
                {% for <?= $entity_twig_var_singular ?> in <?= $entity_twig_var_plural ?> %}
                <tr>
                    <?php foreach ($entity_fields as $field): ?>
                        <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                    <?php endforeach; ?>
                    <td>
                        <a class="btn btn-info btn-circle btn-sm" href="{{ path('<?= $route_name ?>_show', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-info btn-circle btn-sm" href="{{ path('<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                {% else %}
                <tr>
                    <td colspan="<?= (count($entity_fields) + 1) ?>">no records found</td>
                </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>

{% endblock %}
