import './bootstrap';
import '../css/app.css';

function formatTimestamp(createdAt) {
    const created = new Date(createdAt);
    const now = new Date();
    const diffMs = now - created;
    const diffMin = diffMs / (1000 * 60);
    if (diffMin < 1) {
        return '剛剛';
    }
    if (diffMin < 60) {
        return `${Math.floor(diffMin)} 分鐘前`;
    }
    const diffHr = diffMin / 60;
    if (diffHr < 24) {
        return `${Math.floor(diffHr)} 小時前`;
    }
    return created.toLocaleString();
}

let currentPage = 1;
const loadMoreBtn = document.getElementById('load-more');
const threadsContainer = document.getElementById('threads-container');

if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', async () => {
        currentPage++;
        loadMoreBtn.disabled = true;
        loadMoreBtn.innerText = '載入中...';

        try {
            const response = await fetch(`api/messages/load?page=${currentPage}`);
            const result = await response.json();

            result.data.forEach(message => {
                const card = document.createElement('div');
                card.classList.add('thread-card');
                card.innerHTML = `
                    <div class="thread-header">
                        <img src="/icons/user.svg" alt="avatar" class="avatar">
                        <div>
                            <div class="author">${message.user.name}</div>
                            <div class="timestamp">${formatTimestamp(message.created_at)}</div>
                        </div>
                    </div>
                    <div class="thread-content">
                        ${message.content}
                    </div>
                    <div class="thread-actions">
                        <div class="thread-buttons">
                            <button>❤️</button>
                            <span>${message.likes ?? 0}</span>
                        </div>
                        <div class="thread-buttons">
                            <button>💬</button>
                            <span>${message.comments ?? 0}</span>
                        </div>
                        <div>
                            <button>🔁</button>
                        </div>
                    </div>
                `;
                threadsContainer.appendChild(card);
            });

            if (!result.hasMore) {
                loadMoreBtn.remove(); // 沒有更多資料就移除按鈕
            } else {
                loadMoreBtn.disabled = false;
                loadMoreBtn.innerText = '載入更多';
            }

        } catch (e) {
            console.error(e);
            loadMoreBtn.innerText = '載入失敗';
        }
    });
}
