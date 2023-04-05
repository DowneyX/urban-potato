<li>
    <div class="py-5 px-4 my-2 flex justify-between bg-gray-900 rounded">
        <div class="sm:pl-4 pr-8 flex sm:items-center">
            <div class="space-y-1">
                <span class="text-base text-white font-bold tracking-wide">
                    <?= htmlspecialchars($value["course"]->getCourseName()) ?>
                </span>
                <p class="text-sm text-gray-300 font-medium">
                    cijfer:
                    <?= htmlspecialchars($value['enrollment']->getGrade()) ?>
                </p>
            </div>
        </div>
    </div>
</li>