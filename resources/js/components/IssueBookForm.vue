<template>
  <form
    class="px-4 md:px-8 pt-6 pb-2 mb-4 bg-white rounded"
    @submit.prevent="issue"
  >
    <div class="flex flex-col sm:flex-row gap-4">
      <section class="sm:mb-4 w-full">
        <div class="flex justify-between items-baseline">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="rollno"
            >Roll number</label
          >
          <a
            href="/admin/users/create"
            target="_blank"
            class="text-xs text-indigo-500"
            >add new student</a
          >
        </div>
        <input
          type="number"
          name="rollno"
          id="rollno"
          v-model="form.rollno"
          @change="checkUserName"
          placeholder="78945614"
          class="w-full py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
        />
        <p
          class="text-xs italic text-red-500"
          role="alert"
          v-if="errors.rollno"
          v-text="errors.rollno[0]"
        ></p>
      </section>
      <section class="sm:mb-4 w-full">
        <label class="block mb-2 text-sm font-bold text-gray-700" for="course"
          >Course</label
        >
        <select
          name="course"
          id="course"
          @change="checkUserName"
          v-model="form.course"
          class="w-full py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
        >
          <option
            :value="course.id"
            v-for="course in courses"
            :key="course.id"
            v-text="course.name"
          ></option>
        </select>
        <p
          class="text-xs italic text-red-500"
          role="alert"
          v-if="errors.course"
          v-text="errors.course[0]"
        ></p>
      </section>
      <section class="sm:mb-4 w-full">
        <div class="flex justify-between items-baseline">
          <label class="block mb-2 text-sm font-bold text-gray-700" for="isbn"
            >ISBN Number</label
          >
          <a
            href="/admin/books/create"
            target="_blank"
            class="text-xs text-indigo-500"
            >add new book</a
          >
        </div>
        <input
          type="number"
          name="isbn"
          id="isbn"
          v-model="form.isbn"
          @change="loadBookName"
          placeholder="7894561231234"
          class="w-full py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
        />
        <p
          class="text-xs italic text-red-500"
          role="alert"
          v-if="errors.isbn"
          v-text="errors.isbn[0]"
        ></p>
      </section>
    </div>
    <div class="flex flex-col sm:flex-row gap-4 mb-4" v-if="user || book">
      <div class="p-2 rounded-md flex-1 border" v-if="user">
        <div
          class="text-sm text-gray-900 font-bold capitalize"
          v-text="user.name"
        ></div>
        <div class="flex items-center">
          <div
            class="text-xs text-gray-700 font-bold"
            v-text="user.email"
          ></div>
          <div
            class="text-xs text-red-100 font-bold p-1 ml-2 rounded-full bg-red-800"
            title="Book Already Issued and not return"
            v-if="user.issued_count"
            v-text="user.issued_count"
          ></div>
        </div>
      </div>
      <div class="p-2 rounded-md flex-1 border" v-if="book">
        <div
          class="text-sm text-gray-900 font-bold capitalize"
          v-text="book.title"
        ></div>
        <div class="flex items-center">
          <div
            class="text-xs text-gray-700 font-bold capitalize"
            v-text="book.language"
          ></div>
          <div
            class="text-xs text-gray-100 font-bold p-1 ml-2 rounded-full bg-gray-900"
            v-text="book.count"
          ></div>
        </div>
      </div>
    </div>
    <section class="mb-4 text-center">
      <button
        class="w-full bg-indigo-500 active:bg-indigo-800 text-white px-3 sm:px-4 py-2 rounded-full outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md font-bold text-xs"
        type="submit"
      >
        Issue Book
      </button>
    </section>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {},
      errors: {},
      courses: null,
      book: null,
      user: null,
    };
  },
  created() {
    this.fetchCourses();
  },
  methods: {
    fetchCourses() {
      axios.get("/api/courses").then((response) => {
        this.courses = response.data;
      });
    },
    loadBookName() {
      flash("Loading book detail. Please wait", "warning");
      axios
        .get("/api/book/isbn/" + this.form.isbn)
        .then((response) => {
          this.book = response.data;
        })
        .catch((error) => {
          flash("Error, Please check detail and try again.", "danger");
          this.book = null;
        });
    },
    checkUserName() {
      if (this.form.rollno && this.form.course) {
        flash("Loading user detail. Please wait.", "warning");
        axios
          .get("/api/course/" + this.form.course + "/user/" + this.form.rollno)
          .then((response) => {
            this.user = response.data;
          })
          .catch((error) => {
            flash("Error, Please check detail and try again.", "danger");
            this.user = null;
          });
      }
    },
    issue() {
      axios
        .post("/api/admin/issues", this.form)
        .then((response) => {
          if (response.status == 201) {
            window.location = "/admin/issues";
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>