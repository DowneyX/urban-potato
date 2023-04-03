<div class="mx-auto w-full my-5 container bg-white">
    <?php include("TeacherCourseCourseCard.php"); ?>
    <section class="relative py-5 bg-blueGray-50">
        <div class="w-full mb-12 ">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-gray-900">
                <div class="rounded-t mb-0 px-2 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="inline font-semibold text-lg text-white">studenten</h3>
                        </div>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                                    ID inschrijving
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                                    ID student
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                                    email student
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                                    cijfer
                                </th>
                                <th
                                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-gray-800 text-white border-gray-800">
                                    opties
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $value) {
                                include("TeacherCourseEnrollmentRow.php");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </ul>
</div>