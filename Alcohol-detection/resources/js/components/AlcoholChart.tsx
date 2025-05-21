"use client"

import {
  BarChart,
  Bar,
  XAxis,
  Tooltip,
  CartesianGrid,
  ResponsiveContainer,
  LabelList,
} from "recharts"

const chartData = [
  { date: "8 May 2024", value: 1 },
  { date: "14 May 2024", value: 7 },
  { date: "27 June 2024", value: 5 },
  { date: "12 July 2024", value: 3 },
  { date: "25 December 2024", value: 10 },
  { date: "7 January 2025", value: 4 },
  { date: "20 February 2025", value: 1 },
]

export default function AlcoholLevelChart() {
  return (
    <div className="w-full p-4">
      <div className="text-center mb-4">
        <h2 className="text-2xl font-bold leading-tight">Alcohol level & test</h2>
        <p className="text-lg font-semibold text-black">time</p>
      </div>

      <div className="h-[400px] w-full">
        <ResponsiveContainer width="100%" height="100%">
          <BarChart data={chartData}>
            <CartesianGrid strokeDasharray="3 3" vertical={false} />
            <XAxis
              dataKey="date"
              tick={{ fill: "#7f3fff", fontSize: 12 }}
              tickLine={false}
              axisLine={false}
              interval={0}
              angle={-10}
              textAnchor="end"
              height={60}
            />
            <Tooltip />
            <Bar dataKey="value" fill="#7f3fff" radius={[6, 6, 0, 0]}>
              <LabelList
                dataKey="value"
                position="top"
                content={(props) => {
                  const x = typeof props.x === "number" ? props.x : undefined
                  const y = typeof props.y === "number" ? props.y : undefined
                  const value =
                    typeof props.value === "string"
                      ? parseFloat(props.value)
                      : props.value

                  if (x === undefined || y === undefined || value === undefined || isNaN(value)) {
                    return null
                  }

                  return <CircleWithLabel x={x} y={y} value={value} />
                }}
              />
            </Bar>
          </BarChart>
        </ResponsiveContainer>
      </div>
    </div>
  )
}

const CircleWithLabel = ({
  x,
  y,
  value,
}: {
  x: number
  y: number
  value: number
}) => (
  <g transform={`translate(${x},${y - 10})`}>
    <circle r={16} stroke="#7f3fff" strokeWidth={2} fill="white" />
    <text
      x="0"
      y="5"
      textAnchor="middle"
      fontSize={12}
      fill="#7f3fff"
      fontWeight="bold"
    >
      {value}
    </text>
  </g>
)
