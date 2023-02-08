<template>
  <div>
    <div class="content">
      <table class="table table-hover">
        <tr>
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
          <td>{{ task.owner }}</td>
          <td>{{ task.assigned_to }}</td>
          <td>{{ task.created_at }}</td>
          <td>{{ task.due_date }}</td>
        </tr>
      </table>

      <!-- {{ task }} -->
    </div>
  </div>
</template>

<script>
export default {
  props: ["task"],
  methods: {},
};
</script>

<style></style>
