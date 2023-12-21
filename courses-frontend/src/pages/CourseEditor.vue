<template>
  <q-page class="flex">
    <CourseTable
      :courseData="courseData"
      :columns="columns"
      :filter="filter"
      :initialPagination="initialPagination"
      @create-course="displayCreateForm"
      @edit-course="displayEditForm"
      @delete-course="displayDeleteForm"
    >
    </CourseTable>

    <q-dialog v-model="showEditForm">
      <q-card>
        <q-card-section>
          <div class="text-h6">Let's edit a course</div>
        </q-card-section>

        <q-card-section>
          <div class="col">
            <q-input v-model="tempCourseToEdit.title" label="Title" />
          </div>
          <div class="col">
            <q-input
              v-model="tempCourseToEdit.description"
              label="Description"
            />
          </div>
          <div class="col">
            <q-input v-model="tempCourseToEdit.video_url" label="Video URL" />
          </div>
          <div class="col">
            <q-input
              v-model="tempCourseToEdit.video_duration"
              label="Video Duration (seconds)"
            />
          </div>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn
            label="Cancel"
            color="red"
            v-close-popup
            @click="showEditForm = false"
          ></q-btn>
          <q-btn
            label="Save"
            color="primary"
            v-close-popup
            @click="updateCourse()"
            :disable="isEditButtonDisabled"
          ></q-btn>
        </q-card-actions>
      </q-card>
    </q-dialog>

    <q-dialog v-model="showCreateForm">
      <q-card class="q-pa-md">
        <q-card-section>
          <div class="text-h6">Let's create a course</div>
        </q-card-section>

        <q-card-section>
          <div class="col">
            <q-input v-model="emptyCourseToCreate.title" label="Title" />
          </div>
          <div class="col">
            <q-input
              v-model="emptyCourseToCreate.description"
              label="Description"
            />
          </div>
          <div class="col">
            <q-input
              v-model="emptyCourseToCreate.video_url"
              label="Video URL"
            />
          </div>
          <div class="col">
            <q-input
              v-model="emptyCourseToCreate.video_duration"
              label="Video Duration (seconds)"
            />
          </div>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn
            label="Cancel"
            color="red"
            v-close-popup
            @click="showCreateForm = false"
          ></q-btn>
          <q-btn
            label="Save"
            color="primary"
            v-close-popup
            @click="createCourse()"
            :disable="isCreateButtonDisabled"
          ></q-btn>
        </q-card-actions>
      </q-card>
    </q-dialog>

    <q-dialog v-model="showDeleteForm">
      <q-card>
        <q-card-section>
          <div class="text-h6">
            Are you sure you want to delete this course?
          </div>
          <!-- Course Details -->
          <div class="col">
            <q-input v-model="tempCourseToEdit.title" label="Title" readonly />
          </div>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn
            label="Cancel"
            color="red"
            v-close-popup
            @click="showDeleteForm = false"
          ></q-btn>
          <q-btn
            label="Delete"
            color="primary"
            v-close-popup
            @click="deleteCourse()"
          ></q-btn>
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import { QTable, useQuasar } from "quasar";
import axios from "axios";
import { Notify } from "quasar";
import CourseTable from "../components/CourseTable.vue";

export default {
  components: {
    CourseTable,
  },
  setup() {
    const $q = useQuasar();
  },
  data() {
    return {
      // Props for the QTable
      courseData: [],
      columns: [
        {
          name: "id",
          label: "ID",
          field: "id",
          align: "left",
          sortable: true,
        },
        {
          name: "title",
          label: "Title",
          column: "title",
          align: "left",
          sortable: true,
        },
        {
          name: "description",
          label: "Description",
          column: "description",
          align: "left",
          sortable: true,
        },
        {
          name: "video_url",
          label: "Video URL",
          column: "video_url",
          align: "left",
          sortable: true,
        },
        {
          name: "video_duration",
          label: "Video duration",
          column: "video_duration",
          align: "left",
        },
      ],
      filter: "",
      initialPagination: {
        sortBy: "id",
        rowsPerPage: 15,
        descending: true,
      },
      // Display props
      showCreateForm: false,
      showEditForm: false,
      showDeleteForm: false,
      // API props
      tempCourseToEdit: {},
      emptyCourseToCreate: {
        title: "New Course",
        description: "Created at " + new Date().toLocaleString(),
        video_url: "http://localhost:9000/",
        video_duration: 9000,
      },
      baseURL: "http://localhost/",
    };
  },
  async beforeMount() {
    try {
      this.fetchCourses();
    } catch (error) {
      console.error("Error fetching Courses: ", error);
    }
  },
  methods: {
    // Display/Style
    displayEditForm(row) {
      this.tempCourseToEdit = { ...row };
      this.showEditForm = true;
    },
    displayCreateForm(row) {
      this.emptyCourseToCreate = {
        title: "New Course",
        description: "Created at " + new Date().toLocaleString(),
        video_url: "http://localhost:9000/",
        video_duration: 9000,
      };
      this.showCreateForm = true;
    },
    displayDeleteForm(row) {
      this.tempCourseToEdit = { ...row };
      this.showDeleteForm = true;
    },

    // API Calls using Axios
    async fetchCourses() {
      try {
        const response = await axios.get(this.baseURL + "api/courses");
        this.courseData = response.data;
      } catch (error) {
        console.error("Error fetching Courses: ", error);
      }
    },
    async createCourse() {
      try {
        const response = await axios.post(
          this.baseURL + "api/courses",
          this.emptyCourseToCreate,
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        );
        this.$q.notify({
          message: `Course "${this.emptyCourseToCreate.title}" created successfully`,
          color: "green",
          icon: "cloud_done",
          position: "top",
        });
        this.fetchCourses();
      } catch (error) {
        console.error("Error:", error);
      }
    },
    async updateCourse() {
      try {
        const response = await axios.put(
          this.baseURL + "api/courses/" + this.tempCourseToEdit.id,
          this.tempCourseToEdit,
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        );
        console.log("Success:", response.data);
        this.fetchCourses();
        this.$q.notify({
          message: `Course "${this.tempCourseToEdit.title}"" updated successfully`,
          color: "green",
          icon: "cloud_done",
          position: "top",
        });
      } catch (error) {
        console.error("Error:", error);
      }
    },
    async deleteCourse() {
      try {
        const response = await axios.delete(
          this.baseURL + "api/courses/" + this.tempCourseToEdit.id
        );
        console.log("Success:", response.data);
        this.fetchCourses();
        this.$q.notify({
          message: `Course "${this.tempCourseToEdit.title}"" deleted successfully`,
          color: "green",
          icon: "cloud_done",
          position: "top",
        });
      } catch (error) {
        console.error("Error:", error);
      }
    },
  },
  computed: {
    isCreateButtonDisabled() {
      return (
        this.emptyCourseToCreate.title === "" ||
        this.emptyCourseToCreate.description === "" ||
        this.emptyCourseToCreate.video_url === "" ||
        this.emptyCourseToCreate.video_duration === ""
      );
    },
    isEditButtonDisabled() {
      return (
        this.tempCourseToEdit.title === "" ||
        this.tempCourseToEdit.description === "" ||
        this.tempCourseToEdit.video_url === "" ||
        this.tempCourseToEdit.video_duration === ""
      );
    },
  },
};
</script>

<style>
.q-card {
  max-width: 800px;
  width: 80%;
}
</style>
