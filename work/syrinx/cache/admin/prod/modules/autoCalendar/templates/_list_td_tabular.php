<td class="sf_admin_text sf_admin_list_td_title">
  <?php echo $syrinx_calendar->getTitle() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_date">
  <?php echo false !== strtotime($syrinx_calendar->getDate()) ? format_date($syrinx_calendar->getDate(), "dd.MM.yyyy") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_time">
  <?php echo $syrinx_calendar->getTime() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_duration">
  <?php echo $syrinx_calendar->getDuration() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $syrinx_calendar->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_participants">
  <?php echo $syrinx_calendar->getParticipants() ?>
</td>
