<?php

namespace App\Console\Commands;

use App\Models\BusinessReview;
use App\Models\BusinessStat;
use App\Models\Ticket;
use App\Models\TicketChat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseInactiveTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:closeInactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tickets = Ticket::where('ticket_status','pending')->get();

        foreach ($tickets as $ticket) {
            $latestChat = TicketChat::where('sender_id',$ticket->reviewer_user_id)
                ->orderBy('created_at', 'desc')
                ->first();
    

            if ($latestChat) {
                $currentTicket = Ticket::where('id',$ticket->id)->first();

                // Check if the latest message is older than 5 days
                $fiveDaysAgo = Carbon::now()->subDays(5);
                if ($latestChat->created_at->lt($fiveDaysAgo)) {
                    $currentTicket->ticket_status = 'closed';
                    $currentTicket->save();

                    // 
                   $review = BusinessReview::where('id',$ticket->business_review_id)->first();
                   $review->is_approved = 0;
                   $review->save();

                   $accountId = $review->business_account_id;

                   $businessStat = BusinessStat::where('business_account_id', $accountId)->first();
                    $businessStat->avg_rating = BusinessReview::where('business_account_id', $accountId)->where('is_approved', 1)->avg('rating') ?? 0;
                    $businessStat->reviews_count = BusinessReview::where('business_account_id', $accountId)->where('is_approved', 1)->count() ?? 0;
                    $positiveReviewsCount = BusinessReview::where('business_account_id', $accountId)->where('is_approved', 1)->where('rating', '>=', 3)->count() ?? 0;
                    $negativeReviewsCount = $businessStat->reviews_count - $positiveReviewsCount;

                    $businessStat->positive_reviews_count = $positiveReviewsCount;
                    $businessStat->negative_reviews_count = $negativeReviewsCount;
                    $businessStat->save();

                    $this->info("Ticket #{$ticket->id} closed due to inactivity.");

                }
            }
        }
    }
}
