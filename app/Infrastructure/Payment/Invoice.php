<?php

namespace App\Infrastructure\Payment;

class Invoice
{
  private int $amount;
  private string $description;
  private array $data = [];
  private PaymentableInterface $paymentable;

  private function __construct()
  {
  }

  /**
   * @return PaymentableInterface
   */
  public function getPaymentable(): PaymentableInterface
  {
    return $this->paymentable;
  }

  /**
   * @param PaymentableInterface $paymentable
   */
  public function setPaymentable(PaymentableInterface $paymentable): void
  {
    $this->paymentable = $paymentable;
  }

  public static function getInstance(PaymentableInterface $paymentable, $description, $amount, $data): Invoice
  {
    $payment = new Invoice();
    $payment->description = $description;
    $payment->amount = $amount;
    $payment->data = $data;
    $payment->paymentable = $paymentable;
    return $payment;
  }


  /**
   * @return int
   */
  public function getAmount(): int
  {
    return $this->amount;
  }

  /**
   * @return string
   */
  public function getDescription(): string
  {
    return $this->description;
  }

  /**
   * @return array
   */
  public function getData(): array
  {
    return $this->data;
  }


  public function getToken(): string|null
  {
    return $this->paymentable->getToken();
  }


}
