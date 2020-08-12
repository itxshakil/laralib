<template>
  <tr>
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
          <a
            :href="'/admin/users/' + issue.user.id"
            class="text-sm leading-5 font-medium text-gray-900"
            v-text="issue.user.name"
          ></a>
          <div class="text-sm leading-5 text-gray-500" v-text="issue.user.email"></div>
        </div>
      </div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <a
        :href="'/admin/books/' + issue.book.id"
        class="text-sm leading-5 text-gray-900"
        v-text="issue.book.title.slice(0, 32)"
      ></a>
      <div class="text-sm leading-5 text-gray-500" v-text="issue.book.isbn"></div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <div class="text-sm leading-5 text-gray-900" v-text="issue.admin.name"></div>
      <div class="text-sm leading-5 text-gray-500" v-text="dateString(issue.created_at)"></div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
      <div v-if="issue.returned_at" class="flex flex-col items-center">
        <div>
          <div
            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
          >Returned</div>
          <div
            class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
            v-text="issue.fine"
            v-if="issue.fine > 0"
          ></div>
        </div>
        <div class="text-sm leading-5 text-gray-500" v-text="dateString(issue.returned_at)"></div>
      </div>
      <div v-else>
        <div
          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
        >Issued</div>
        <div
          class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
          v-text="issue.fine"
          v-if="issue.fine > 0"
        ></div>
      </div>
    </td>
    <td
      class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
    >
      <button
        v-if="issue.returned_at == null"
        @click="returned"
        class="text-indigo-600 hover:text-indigo-900"
      >Save as returned</button>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      issue: this.data,
    };
  },
  methods: {
    dateString(date) {
      date = new Date(date);
      return date.toDateString();
    },
    returned() {
      axios
        .put("/admin/issues/" + this.issue.id)
        .then((response) => {
          this.issue.returned_at = new Date();
        })
        .catch((error) => {
          console.log(error.response.statusText);
        });
    },
  },
};
</script>

<style>
</style>