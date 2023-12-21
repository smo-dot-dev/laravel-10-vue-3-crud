<template>
  <q-table
    style="width: 100%"
    :rows="courseData"
    :columns="columns"
    :filter="localFilter"
    :pagination="initialPagination"
    row-key="id"
    no-data-label="No courses found. Make sure to seed the DB and read the README.md"
  >
    <template v-slot:top-left>
      <q-btn
        color="primary"
        label="Create a new course"
        @click="$emit('create-course')"
      />
    </template>

    <template v-slot:top-right>
      <q-input
        borderless
        dense
        debounce="300"
        v-model="localFilter"
        placeholder="Search"
      >
        <template v-slot:append>
          <q-icon name="search" />
        </template>
      </q-input>
    </template>

    <template v-slot:body="props">
      <q-tr :props="props">
        <q-td :key="column.name" v-for="column in columns" :props="props">
          {{
            column.name === "video_duration"
              ? formatDuration(props.row[column.name])
              : props.row[column.name]
          }}
        </q-td>

        <q-td>
          <q-btn
            flat
            round
            color="primary"
            @click="$emit('edit-course', props.row)"
            icon="edit"
          ></q-btn>
          <q-btn
            flat
            round
            color="red"
            icon="delete"
            @click="$emit('delete-course', props.row)"
          ></q-btn>
        </q-td>
      </q-tr>
    </template>
  </q-table>
</template>

<script>
export default {
  props: {
    courseData: Array,
    columns: Array,
    filter: String,
    initialPagination: Object,
  },
  data() {
    return {
      localFilter: this.filter,
    };
  },
  methods: {
    formatDuration(duration) {
      const hours = Math.floor(duration / 3600);
      const minutes = Math.floor((duration % 3600) / 60);
      const seconds = duration % 60;

      return [hours, minutes, seconds]
        .map((v) => (v < 10 ? "0" + v : v))
        .filter((v, i) => v !== "00" || i > 0)
        .join(":");
    },
  },
};
</script>
