<template>
  <div class="flex flex-col">
    <input
      type="search"
      name="search"
      id="search"
      @change="fetch"
      v-model="search"
      placeholder="Search Name or Rollno"
      class="w-full sm:w-2/12 my-2 self-end py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"
    />
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div
        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
      >
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Name</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Course</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Status</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Role</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                <select
                  name="filter"
                  id="filter"
                  @change="fetch"
                  v-model="course"
                  class="w-full py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700"
                >
                  <option value>All Courses</option>
                  <option
                    :value="course.id"
                    v-for="course in courses"
                    :key="course.id"
                    v-text="course.name"
                  ></option>
                </select>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users" :key="user.id">
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img
                      class="h-10 w-10 rounded-full"
                      src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                      alt
                    />
                  </div>
                  <div class="ml-4">
                    <div class="text-sm leading-5 font-medium text-gray-900" v-text="user.name"></div>
                    <div class="text-sm leading-5 text-gray-500" v-text="user.email"></div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="text-sm leading-5 text-gray-900" v-text="user.course.name"></div>
                <div class="text-sm leading-5 text-gray-500" v-text="user.rollno"></div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                  v-if="user.email_verified_at"
                >Verified</span>
                <span
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                  v-else
                >Unverified</span>
              </td>
              <td
                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
              >Student</td>
              <td
                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
              >
                <a
                  :href="'/admin/users/'+user.id+'/edit'"
                  class="text-indigo-600 hover:text-indigo-900"
                >Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="flex rounded justify-center items-center">
          <a
            :href="links.prev"
            v-show="links.current_page !== 1"
            @click.prevent="fetch(--links.current_page)"
            class="px-4 py-2 m-2 border rounded bg-indigo-500 text-white cursor-pointer"
          >Previous</a>
          <a
            :href="links.next"
            v-show="links.last_page != links.current_page"
            @click.prevent="fetch(++links.current_page)"
            class="px-4 py-2 m-2 border rounded bg-indigo-500 text-white cursor-pointer"
          >Next</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: {},
      links: {},
      courses: {},
      course: "",
      search: "",
    };
  },
  created() {
    this.fetch();
    this.fetchCourses();
  },
  methods: {
    fetch(page) {
      axios.get(this.url(page)).then(this.refresh);
    },
    url(page) {
      if (!page || isNaN(page)) {
        let query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
      }
      let route = "/api/admin/users?page=" + page;
      if (this.course) {
        route += "&course=" + this.course;
      }
      if (this.search) {
        route += "&search=" + this.search;
      }
      return route;
    },
    refresh({ data }) {
      this.users = data.data;
      this.links = data.meta;
    },
    fetchCourses() {
      axios.get("/api/courses").then((response) => {
        this.courses = response.data;
      });
    },
  },
};
</script>
<style>
</style>