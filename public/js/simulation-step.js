function setupStep(totalSeries, circleOffset, formId) {
    let currentSeries = 0;

    function showSeries(index) {
        document.querySelectorAll('.series').forEach((series, i) => {
            series.classList.toggle('hidden', i !== index);
        });
        document.getElementById('prevButton').disabled = (index === 0);
        document.getElementById('nextButton').disabled = (index === totalSeries - 1);
    }

    window.selectPhoto = function (photoId, groupIndex) {
        document.querySelectorAll(`#series-${groupIndex} .photo-item`).forEach(item => {
            item.classList.remove('selected');
            const img = item.querySelector('img');
            if (img) {
                const iconId = img.id.replace('photo', 'checkIcon');
                document.getElementById(iconId)?.classList.add('hidden');
            }
        });

        const itemDiv = document.getElementById(`photoItem-${groupIndex}-${photoId}`);
        if (itemDiv) {
            itemDiv.classList.add('selected');
            const checkIcon = document.getElementById(`checkIcon-${groupIndex}-${photoId}`);
            if (checkIcon) checkIcon.classList.remove('hidden');
        }

        document.getElementById(`selectedPhoto-${groupIndex}`).value = photoId;

        const circleId = `circle-${circleOffset + groupIndex}`;
        document.getElementById(circleId)?.classList.add('active');

        const allSelected = Array.from({ length: totalSeries }, (_, i) =>
            document.getElementById(`selectedPhoto-${i}`).value
        ).every(val => val !== '');

        if (allSelected && currentSeries === totalSeries - 1) {
            document.getElementById(formId).submit();
        }
    }

    document.getElementById('prevButton').addEventListener('click', () => {
        if (currentSeries > 0) {
            currentSeries--;
            showSeries(currentSeries);
        }
    });
    document.getElementById('nextButton').addEventListener('click', () => {
        if (currentSeries < totalSeries - 1) {
            currentSeries++;
            showSeries(currentSeries);
        }
    });

    showSeries(0);
}
