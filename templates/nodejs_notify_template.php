<?php

/**
 * @file
 * Templates.
 */

$NODEJS_NOTIFY_TEMPLATE['NOTIFICATIONS']['GROUP'] = '
<div class="panel panel-default">
	<div class="panel-heading">
    	<strong>{GROUP_TITLE}</strong>
	</div>
	<div class="panel-body">
		{GROUP_DESCRIPTION}
	</div>
	{GROUP_ITEMS}
</div>
';

$NODEJS_NOTIFY_TEMPLATE['NOTIFICATIONS']['GROUP_ITEMS']['HEADER'] = '
<table class="table">
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th class="text-center">{TITLE_ALERT}</th>
			<th class="text-center">{TITLE_SOUND}</th>
		</tr>
	</thead>
	<tbody>
';

$NODEJS_NOTIFY_TEMPLATE['NOTIFICATIONS']['GROUP_ITEMS']['ROW'] = '
		<tr>
			<th scope="row"></th>
			<td>{ITEM_LABEL}</td>
			<td class="text-center">{ITEM_ALERT}</td>
			<td class="text-center">{ITEM_SOUND}</td>
		</tr>
';

$NODEJS_NOTIFY_TEMPLATE['NOTIFICATIONS']['GROUP_ITEMS']['FOOTER'] = '
	</tbody>
</table>
';
