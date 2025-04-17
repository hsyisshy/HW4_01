import "./bootstrap";
import "../css/app.css";

function formatTimestamp(createdAt) {
    const created = new Date(createdAt);
    const now = new Date();
    const diffMs = now - created;
    const diffMin = diffMs / (1000 * 60);
    if (diffMin < 1) return "剛剛";
    if (diffMin < 60) return `${Math.floor(diffMin)} 分鐘前`;
    const diffHr = diffMin / 60;
    if (diffHr < 24) return `${Math.floor(diffHr)} 小時前`;
    return created.toLocaleString();
}

let currentPage = 1;
let loading = false;
let hasMore = true;

const spinner = document.getElementById("loading-spinner");
const threadsContainer = document.getElementById("threads-container");

async function loadMoreMessages() {
    if (loading || !hasMore) return;

    loading = true;
    spinner.classList.remove("hidden");
    spinner.classList.add("flex")

    try {
        currentPage++;
        const response = await fetch(`api/messages/load?page=${currentPage}`);
        const result = await response.json();

        await new Promise(resolve => setTimeout(resolve, 800)); // 延遲 800ms

        result.data.forEach((message) => {
            const card = document.createElement("div");
            card.classList.add("thread-card");
            card.innerHTML = `
                <div class="thread-header">
                    <img src="/icons/user.svg" alt="avatar" class="avatar">
                    <div>
                        <div class="author">${message.user.name}</div>
                        <div class="timestamp">${formatTimestamp(
                            message.created_at
                        )}</div>
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

        hasMore = result.hasMore;
        if (!hasMore) spinner.remove();
    } catch (error) {
        console.error(error);
        currentPage--;
        hasMore = true;
    } finally {
        loading = false;
        spinner.classList.add("hidden");
    }
}

// ✅ 只在滑到最底時觸發一次
window.addEventListener("scroll", async () => {
    const scrollTop = window.scrollY;
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;

    const reachedBottom = scrollTop + windowHeight >= documentHeight - 1;

    if (reachedBottom) {
        await loadMoreMessages();
    }
});
