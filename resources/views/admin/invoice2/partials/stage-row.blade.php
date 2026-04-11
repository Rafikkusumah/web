<tr class="stage-row border-b border-gray-200">
    <td class="px-4 py-2">
        <input type="text" name="stages[{{ $index }}][stage_name]" placeholder="e.g. Down Payment" value="{{ $stage['stage_name'] ?? '' }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
    </td>
    <td class="px-4 py-2">
        <input type="number" name="stages[{{ $index }}][stage_percentage]" placeholder="%" value="{{ $stage['stage_percentage'] ?? '' }}" step="0.01" min="0" max="100" required
            class="stage-percentage w-full px-3 py-2 border border-gray-300 rounded text-sm"
            oninput="updateTotalPercentage()">
    </td>
    <td class="px-4 py-2">
        <input type="date" name="stages[{{ $index }}][stage_due_date]" value="{{ $stage['stage_due_date'] ?? '' }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
    </td>
    <td class="px-4 py-2">
        <textarea name="stages[{{ $index }}][stage_notes]" placeholder="Optional notes" rows="1"
            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">{{ $stage['stage_notes'] ?? '' }}</textarea>
    </td>
    <td class="px-4 py-2">
        <button type="button" onclick="removeStageRow(this)" class="text-red-600 hover:text-red-900">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
    </td>
</tr>
