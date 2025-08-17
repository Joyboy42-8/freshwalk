<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        .client-info {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Facture #{{ $commande->id }}</h1>

    <div class="client-info">
        <p><strong>Client :</strong> {{ $commande->user->name }}</p>
        <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire (FCFA)</th>
                <th>Total (FCFA)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->pivot->quantite }}</td>
                    <td>{{ number_format($produit->prix, 0, ',', ' ') }}</td>
                    <td>{{ number_format($produit->prix * $produit->pivot->quantite, 0, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total : {{ number_format($commande->prix_total, 0, ',', ' ') }} FCFA</p>

</body>
</html>
