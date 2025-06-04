<?php

namespace App\Traits;

use App\Enums\Payments\PaymentStatus;
use App\Exceptions\PaymentProcessException;
use App\Models\Abstract\Payable;
use App\Models\Payment;
use Exception;
use Filament\Notifications\Notification;

trait HasPaymentActions
{
    public function generateAndSend(Payable $record, array $data): void
    {
        try {
            $payment = $this->generateCustomPaymentLink($record, $data);
            $this->sendPaymentLink($payment);
            $this->notifySuccess(
                __('dashboard.Payment link generated & sent'),
                __(
                    'dashboard.A new payment link has been generated & sent to the customer'
                )
            );
        } catch (PaymentProcessException $e) {
            $this->notifyError($e);
        }
    }

    /**
     * @throws PaymentProcessException
     */
    private function generateCustomPaymentLink(
        Payable $record,
        array $data
    ): Payment {
        try {
            return $record->createPayment([
                'amount' => $data['amount'],
                'currency_code' => config('app.money_currency'),
                'status' => PaymentStatus::PENDING,
                'note' => $data['note'],
            ]);
            // TODO: Add note to payment and send with the notification
        } catch (Exception $e) {
            throw new PaymentProcessException(
                'Failed to generate payment link',
                $e->getMessage(),
                0,
                $e
            );
        }
    }

    /**
     * @throws PaymentProcessException
     */
    private function sendPaymentLink(Payment $payment): void
    {
        try {
            $payable = $payment->payable;

            // TODO: send whatsapp notification

            //            app(WhatsAppNotificationService::class)->sendAndSave(
            //                CPaymentLinkHandler::class,
            //                $payable,
            //                isUpdate: true
            //            );
        } catch (Exception $e) {
            throw new PaymentProcessException(
                'Failed to send payment link',
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    private function notifySuccess(string $title, string $body): void
    {
        Notification::make()->title($title)->body($body)->success()->send();
    }

    public function send(Payment $payment): void
    {
        try {
            $this->sendPaymentLink($payment);
            $this->notifySuccess(
                __('dashboard.Payment link sent'),
                __('dashboard.The payment link has been sent to the customer')
            );
        } catch (PaymentProcessException $e) {
            $this->notifyError($e);
        }
    }

    private function notifyError(PaymentProcessException $e): void
    {
        Notification::make()
            ->title($e->getNotificationTitle())
            ->body('Error: '.$e->getMessage())
            ->danger()
            ->send();
    }

    public function generate(Payable $record, array $data): ?Payment
    {
        try {
            $payment = $this->generateCustomPaymentLink($record, $data);
            $this->notifySuccess(
                __('dashboard.Payment link generated'),
                __(
                    'dashboard.A new payment link has been generated successfully'
                )
            );

            return $payment;
        } catch (PaymentProcessException $e) {
            $this->notifyError($e);

            return null;
        }
    }
}
