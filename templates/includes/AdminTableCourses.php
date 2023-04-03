<div class="container mx-auto">
  <section class="relative py-16 bg-blueGray-50">
    <div class="w-full mb-12 px-4">
      <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-800">
        <div class="rounded-t mb-0 px-2 py-3 border-0">
          <div class="flex flex-wrap items-center">
            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
              <h3 class="inline font-semibold text-lg text-white">Cursusen</h3>
            </div>
          </div>
        </div>
        <div class="block w-full overflow-x-auto">
          <table class="items-center w-full bg-transparent border-collapse">
            <thead>
              <tr>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-700 text-white border-gray-800">
                  ID
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-700 text-white border-gray-800">
                  cursus naam
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-700 text-white border-gray-800">
                  jaar
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-700 text-white border-gray-800">
                  examinator_id
                </th>
                <th
                  class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-700 text-white border-gray-800">
                  opties
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($params["courses"] as $course) {
                echo ('
                <tr>
                <td
                  class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                  ' . $course->getId() . ' 
                </td>
                <td
                  class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                  ' . $course->getCourseName() . ' 
                </td>
                <td
                  class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                  ' . $course->getYear() . ' 
                </td>
                <td
                  class="border-t-0 text-gray-500 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                  ' . $course->getExaminorId() . ' 
                </td>
                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                  <a href="">
                    <span class="inline px-3 py-2 rounded-lg hover:bg-green-900 shadow-lg bg-green-600"><i
                        class="text-white">UPD</i></span>
                  </a>
                  <a href="">
                    <span class="inline px-3 py-2 rounded-lg hover:bg-red-900 shadow-lg bg-red-600"><i
                        class="text-white">DEL</i></span>
                  </a>
                </td>
              </tr> 
                ');
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>