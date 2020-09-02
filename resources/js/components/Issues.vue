<template>
  <div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div
        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
      >
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >User</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Book</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Admin</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >Status</th>
              <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
              >
                <select
                  name="filter"
                  id="filter"
                  @change="updateFilter"
                  v-model="currentFilter"
                  class="w-full py-2 px-4 border text-sm font-medium rounded-md focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700"
                >
                  <option value>All Books</option>
                  <option
                    :value="filter.key"
                    v-for="filter in filters"
                    :key="filter.id"
                    v-text="filter.name"
                  ></option>
                </select>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <issue v-for="issue in issues" :key="issue.id" :data="issue"></issue>
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
import issue from "./Issue";
export default {
  components: { issue },
  data() {
    return {
      issues: null,
      links: {},
      filters: [
        { id: 1, key: "issued", name: "Issued Books" },
        { id: 2, key: "returned", name: "Returned Books" },
      ],
      currentFilter: "",
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    fetch(page) {
      axios.get(this.url(page)).then(this.refresh);
    },
    url(page) {
      if (!page) {
        let query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
      }
      if (this.currentFilter) {
        return "/api/admin/issues?page=" + page + "&" + this.currentFilter;
      }
      return "/api/admin/issues?page=" + page;
    },
    refresh({ data }) {
      this.issues = data.data;
      this.links = data.meta;
    },
    dateString(date) {
      date = new Date(date);
      return date.toDateString();
    },
    updateFilter() {
      this.fetch();
    },
    dateInterval(date) {
      date = new Date(date);
      let today = new Date();

      return today.getDate() - date.getDate();
    },
  },
};
</script>
<style></style>
